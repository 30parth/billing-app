<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt(Str::random(16)), // Fallback password
            ]);

            Auth::login($user);

            return redirect()->intended(route('dashboard')); // Change to your default redirect route
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong during Google authentication.');
        }
    }
}
