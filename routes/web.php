<?php

use Illuminate\Support\Facades\Route;

// ---------- ADMIN ROUTES ----------
Route::prefix('admin')->group(function () {
    // --- public admin routeok belepeshez
    Route::get('/login', [\App\Http\Controllers\admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\admin\LoginController::class, 'login'])->name('admin.login.submit');
    // --- vedett admin routeok
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [\App\Http\Controllers\admin\LoginController::class, 'logout'])->name('admin.logout');
    });
});


// ---------- USER ROUTES ----------
// Publikus user routok
Route::get('/login', [\App\Http\Controllers\user\LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [\App\Http\Controllers\user\LoginController::class, 'login'])->name('user.login.submit');
Route::get('/register', [\App\Http\Controllers\user\RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/register', [\App\Http\Controllers\user\RegisterController::class, 'register'])->name('user.register.submit');

// Védett user routok - 404 ha nincs belépve
Route::middleware(['user.auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\user\DashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/logout', [\App\Http\Controllers\user\LoginController::class, 'logout'])->name('user.logout');
});

