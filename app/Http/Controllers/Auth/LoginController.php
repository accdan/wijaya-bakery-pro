<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showAdminLoginForm()
    {
        return view('auth.login-admin');
    }

    public function showUserLoginForm()
    {
        return view('auth.login-user');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->role && $user->role->role_name === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard-admin');
            }

            Auth::logout();
            return back()->with('error', 'Akun ini bukan admin.');
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->role && $user->role->role_name === 'pengguna') {
                $request->session()->regenerate();
                return redirect()->intended('/user/dashboard');
            }

            Auth::logout();
            return back()->with('error', 'Akun ini bukan pengguna.');
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }
}

