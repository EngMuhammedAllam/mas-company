<?php

namespace Modules\Auth\App\Http\Controllers\Front\Socialite;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Traits\ResponseTrait;
use App\Models\User;

class GithubController extends Controller
{
    use ResponseTrait;


    public function redirectToGithub()
    {
        $url = Socialite::driver('github')->redirect()->getTargetUrl();
        return $this->jsonResponseSuccess(['url' => $url], 'GitHub redirect URL generated successfully');
    }

    public function handleGithubCallback()
    {
        try {
            // Get user data from GitHub (stateless for APIs)
            $githubUser = Socialite::driver('github')->stateless()->user();

            $email = $githubUser->getEmail();
            $name  = $githubUser->getName();
            $avatar = $githubUser->getAvatar();

            // Check if user already exists
            $user = User::where('email', $email)->first();

            if (!$user) {
                // Create a new user if not exist
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt(str()->random(16)), // random password
                    'github_id' => $githubUser->getId(), // optional column if exists
                ]);
            }

            // Log the user in (API Token)
            $token = $user->createToken('github_token')->plainTextToken;

            return $this->jsonResponseSuccess([
                'user'  => $user,
                'token' => $token
            ], 'User logged in successfully via GitHub');
        } catch (\Exception $e) {
            return $this->sendResponseError('GitHub authentication failed', 500, $e->getMessage());
        }
    }
}
