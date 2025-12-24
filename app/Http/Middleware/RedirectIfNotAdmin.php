<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if admin user is logged in via admin guard
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login-admin')->with('error', 'Silakan login sebagai admin.');
        }

        // Additional check: ensure the logged-in admin user has admin role
        $user = Auth::guard('admin')->user();
        if (!$user || !$user->role || $user->role->role_name !== 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('login-admin')->with('error', 'Akses ditolak. Anda tidak memiliki hak admin.');
        }

        return $next($request);
    }
}

