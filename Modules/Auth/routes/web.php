<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\HeroSectionController;


// ############################## Auth Routes ################################### //
Route::prefix('auth')->group(function () {
    Route::get('/login-form', [AuthController::class, 'loginForm'])->name('loginform');
    Route::post('/dashboard/login', [AuthController::class, 'login'])->name('dashboard.login');
})->middleware('guest');

Route::prefix('auth')->group(function () {
    Route::get('/dashboard/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
});
