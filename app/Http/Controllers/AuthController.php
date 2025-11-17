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

        $user = User::where('username', $request->username)->first();
        // dd($user);
        if (!$user || $user->role_id !== '6ef8fcb8-7bd8-4279-b26b-b06b20b78043') {
            return back()->with('error', 'Username tidak ditemukan atau bukan admin.')
                        ->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')
                        ->withInput($request->only('username'));
        }

        Auth::guard('admin')->login($user);
        $request->session()->regenerate();

        // dd(Auth::guard('admin')->user());

        return redirect('/dashboard-admin');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
