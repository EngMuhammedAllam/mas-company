<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\Api\RegisterController;
use Modules\Auth\App\Http\Controllers\Api\LoginController;
use Modules\Auth\App\Http\Controllers\Api\AuthController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use Modules\Auth\App\Http\Controllers\Api\Socialite\GoogleController;
use Modules\Auth\App\Http\Controllers\Api\Socialite\GithubController;
use Modules\Auth\App\Http\Controllers\Api\Socialite\FacebookController;
use Modules\Auth\App\Http\Controllers\Api\ResetPassword\PasswordResetController;

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('auths', AuthController::class)->names('auth');
// });


// Public Routes
Route::group(['prefix' => 'v1/auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes
// Route::group(['prefix' => 'v1/auth', 'middleware' => ['auth:sanctum']], function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

Route::middleware('web')->prefix('auth')->group(function () {
    // Google OAuth Routes
    Route::get('/redirect', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/callback', [GoogleController::class, 'handleGoogleCallback']);

    // GitHub OAuth Routes (if needed)
    Route::get('/github/redirect', [GithubController::class, 'redirectToGithub']);
    Route::get('/github/callback', [GithubController::class, 'handleGithubCallback']);

    // facebook OAuth Routes (if needed)
    Route::get('/facebook/redirect', [FacebookController::class, 'redirectToFacebook']);
    Route::get('/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
});

// Password Reset Routes
Route::prefix('v1')->group(function () {

    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail']);
    Route::post('verify-reset-token', [PasswordResetController::class, 'verifyToken']);
    Route::post('reset-password', [PasswordResetController::class, 'reset']);
});
