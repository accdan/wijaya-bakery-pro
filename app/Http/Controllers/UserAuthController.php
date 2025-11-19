<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-user');
    }

    public function showRegisterForm()
    {
        return view('auth.register-user');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan.')
                        ->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')
                        ->withInput($request->only('username'));
        }

        // Check if user role is not admin
        if ($user->isAdmin()) {
            return back()->with('error', 'Gunakan halaman login admin untuk akun admin.')
                        ->withInput($request->only('username'));
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'no_telepon' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Get user role ID - automatically assign as 'pengguna' (customer)
        $userRole = Role::where('role_name', 'pengguna')->first();
        if (!$userRole) {
            return back()->with('error', 'Role pengguna tidak ditemukan. Silakan hubungi administrator.');
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => Hash::make($request->password),
            'role_id' => $userRole->id,
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang di Wijaya Bakery.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }

    // Google OAuth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Get user role
                $userRole = Role::where('role_name', 'pengguna')->first();
                if (!$userRole) {
                    return redirect('/login-user')->with('error', 'Role pengguna tidak ditemukan.');
                }

                // Create new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'username' => $googleUser->email, // Use email as username for Google users
                    'email' => $googleUser->email,
                    'no_telepon' => null, // Google doesn't provide phone
                    'password' => Hash::make(Str::random(16)), // Random password
                    'role_id' => $userRole->id,
                ]);
            }

            Auth::login($user);

            return redirect('/')->with('success', 'Login dengan Google berhasil!');
        } catch (\Exception $e) {
            return redirect('/login-user')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }

    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        // Get user's order history
        $orders = \App\Models\Pesanan::where('nama_pemesan', $user->name)
            ->where('no_hp', $user->no_telepon)
            ->with('menu')
            ->latest()
            ->get()
            ->groupBy(function($item) {
                // Group by timestamp for each order batch
                return $item->created_at->format('Y-m-d H:i:s');
            });

        // Get cart count
        $cartCount = \App\Models\Cart::where('user_id', $user->id)->sum('quantity');

        return view('user.profile', compact('user', 'orders', 'cartCount'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'province' => 'nullable|string|max:255',
            'regency' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'hamlet' => 'nullable|string|max:255',
            'address_notes' => 'nullable|string|max:500',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Get province name from API if province ID is provided
        $provinceName = $request->province;
        if (is_numeric($request->province)) {
            try {
                $regionService = new \App\Services\IndonesiaRegionService();
                $provinces = $regionService->getProvinces();
                $provinceData = collect($provinces)->firstWhere('id', $request->province);
                $provinceName = $provinceData ? $provinceData['name'] : $request->province;
            } catch (\Exception $e) {
                $provinceName = $request->province;
            }
        }

        $user->update([
            'province' => $provinceName,
            'regency' => $request->regency,
            'street' => $request->district, // district field becomes street
            'hamlet' => $request->hamlet,
            'address_notes' => $request->address_notes,
        ]);

        return redirect()->route('user.profile')->with('success', 'Alamat berhasil diperbarui!');
    }

    // Indonesian Regions API Methods
    public function getRegencies($provinceId)
    {
        $regionService = new \App\Services\IndonesiaRegionService();
        $regencies = $regionService->getRegencies($provinceId);

        return response()->json($regencies);
    }

    public function getDistricts($regencyId)
    {
        $regionService = new \App\Services\IndonesiaRegionService();
        $districts = $regionService->getDistricts($regencyId);

        return response()->json($districts);
    }

    public function getVillages($districtId)
    {
        $regionService = new \App\Services\IndonesiaRegionService();
        $villages = $regionService->getVillages($districtId);

        return response()->json($villages);
    }

    /**
     * Display detailed view of a specific order
     */
    public function orderDetail($timestamp)
    {
        // Validate that the user owns this order
        $user = Auth::user();

        // Get order items for this timestamp, belonging to the authenticated user
        $orderItems = \App\Models\Pesanan::where('nama_pemesan', $user->name)
            ->where('no_hp', $user->no_telepon)
            ->where('created_at', 'LIKE', $timestamp . '%')
            ->with(['menu', 'promo'])
            ->get();

        if ($orderItems->isEmpty()) {
            return redirect()->route('user.profile')->with('error', 'Order tidak ditemukan');
        }

        // Parse timestamp for display
        $orderDate = \Carbon\Carbon::parse($timestamp);

        // Calculate totals including discounts
        $subtotal = $orderItems->sum('total_harga');
        $discountTotal = $orderItems->sum(function($item) {
            return $item->discount_amount ?? 0;
        });
        $finalTotal = $orderItems->sum(function($item) {
            return $item->final_price ?? $item->total_harga;
        });

        return view('user.order-detail', compact(
            'orderItems',
            'orderDate',
            'timestamp',
            'subtotal',
            'discountTotal',
            'finalTotal'
        ));
    }

    // Password Reset Methods (Simplified for Local Development)
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPasswordSimple(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string', // Can be username or email
            'password' => 'required|min:8|confirmed',
        ]);

        // Find user by username or email
        $user = User::where('username', $request->identifier)
                   ->orWhere('email', $request->identifier)
                   ->first();

        if (!$user) {
            return back()->withErrors(['identifier' => 'Username atau email tidak ditemukan']);
        }

        // Reset password directly (for development/testing only)
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.login.form')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }
}
