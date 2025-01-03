<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $exception) {
            return redirect()->route('filament.admin.auth.login')
                ->with('error', 'Google Login failed, please try again.');
        }

        $user_email = (string) $socialUser->getEmail();

        if (! User::isValidDomain($user_email)) {
            return redirect()->route('filament.admin.auth.login')
                ->with('error', 'Invalid Domain.');
        }

        $user = User::where('email', $user_email)->first();

        if (env('ALLOW_SIGN_UP', false) && ! $user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(32)),
            ]);

            User::attachRole($user);
        }

        if (! $user) {
            return redirect()->route('filament.admin.auth.login')
                ->with('error', 'User not found.');
        }

        $user->update([
            'name' => $socialUser->getName(),
        ]);

        Auth::login($user);

        return redirect()->intended('/admin');
    }
}
