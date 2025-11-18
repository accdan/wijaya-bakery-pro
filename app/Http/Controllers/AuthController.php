<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function showAdminLoginForm()
    {
        return view('auth.login-admin');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->with('role')->first();

        // Check if user exists, has admin role, and role is active
        if (!$user || !$user->role || $user->role->role_name !== 'admin' || !$user->role->role_status) {
            return back()->with('error', 'Username tidak ditemukan atau bukan admin.')
                        ->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')
                        ->withInput($request->only('username'));
        }

        Auth::guard('admin')->login($user);
        $request->session()->regenerate();

        return redirect('/dashboard-admin')->with('success', 'Login admin berhasil!');
    }

    public function logout(Request $request)
    {
        // Logout from all guards
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('users')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
