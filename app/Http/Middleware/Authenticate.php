<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!Auth::guard('admin')->check()) {
            return '/login-user';
        }

        return null;
    }
}

