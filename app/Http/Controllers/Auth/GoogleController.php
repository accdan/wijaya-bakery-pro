<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'username' => Str::slug($googleUser->getName()) . rand(1000, 9999),
                    'password' => bcrypt(Str::random(16)), // password random
                    'profile_picture' => $googleUser->getAvatar(),
                ]
            );

            Auth::login($user);

            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google');
        }
    }
}

