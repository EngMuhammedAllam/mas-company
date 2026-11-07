<?php

namespace Modules\Auth\App\Http\Controllers\Api\Socialite;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Traits\ResponseTrait;
use App\Models\User;

class FacebookController extends Controller
{
    use ResponseTrait;


    public function redirectToFacebook()
    {
        $url = Socialite::driver('facebook')->scopes(['email'])->redirect()->getTargetUrl();
        return $this->jsonResponseSuccess(['url' => $url], 'Facebook redirect URL generated successfully');
    }

    public function handleFacebookCallback()
    {
        try {
            // Get user data from Facebook (stateless for APIs)
            $facebookUser =  Socialite::driver('facebook')->stateless()->user();

            return $facebookUser;

            $email = $facebookUser->getEmail();
            $name  = $facebookUser->getName();
            $avatar = $facebookUser->getAvatar();

            // Check if user already exists
            $user = User::where('email', $email)->first();

            if (!$user) {
                // Create a new user if not exist
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt(str()->random(16)), // random password
                    'facebook_id' => $facebookUser->getId(), // optional column if exists
                ]);
            }

            // Log the user in (API Token)
            $token = $user->createToken('facebook_token')->plainTextToken;

            return $this->jsonResponseSuccess([
                'user'  => $user,
                'token' => $token
            ], 'User logged in successfully via Facebook');
        } catch (\Exception $e) {
            return $this->sendResponseError('Facebook authentication failed', 500, $e->getMessage());
        }
    }
}
