<?php

namespace Modules\Auth\App\Http\Services\Blade;

use Modules\Auth\App\Http\Repository\Api\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginService
{
    private $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($request)
    {
        try {
            // Check if the user exists
            $user = $this->repository->find($request);

            // Check if the password is correct
            if (! $user || ! Hash::check($request->password, $user->password)) {
                return redirect()
                    ->route('loginform')
                    ->with('error', 'Invalid credentials.');
            }

            // Login the user
            $user = Auth::login($user);

            // Redirect to the dashboard
            return redirect()
                ->route('dashboard')
                ->with('success', 'Logged in successfully.');
        } catch (Exception $e) {
            return redirect()
                ->route('loginform')
                ->with('error', 'Error: ' . 'Something went wrong.');
        }
    }
}
