<?php

namespace Modules\Auth\App\Http\Controllers\Api\Socialite;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Traits\ResponseTrait;
use App\Models\User;

class GoogleController extends Controller
{
    use ResponseTrait;


    public function redirectToGoogle()
    {
        $url = Socialite::driver('google')->redirect()->getTargetUrl();
        return $this->jsonResponseSuccess(['url' => $url], 'Google redirect URL generated successfully');
    }

    public function handleGoogleCallback()
    {
        try {
            // Get user data from Google (stateless for APIs)
            $googleUser = Socialite::driver('google')->stateless()->user();

            $email = $googleUser->getEmail();
            $name  = $googleUser->getName();
            $avatar = $googleUser->getAvatar();

            // Check if user already exists
            $user = User::where('email', $email)->first();

            if (!$user) {
                // Create a new user if not exist
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt(str()->random(16)), // random password
                    'google_id' => $googleUser->getId(), // optional column if exists
                ]);
            }

            // Log the user in (API Token)
            $token = $user->createToken('google_token')->plainTextToken;

            return $this->jsonResponseSuccess([
                'user'  => $user,
                'token' => $token
            ], 'User logged in successfully via Google');
        } catch (\Exception $e) {
            return $this->sendResponseError('Google authentication failed', 500, $e->getMessage());
        }
    }
}
