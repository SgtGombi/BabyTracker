<?php

use Illuminate\Support\Facades\Route;


// ---------- PUBLIC ROUTES ----------
// CSIMBI: ezt törölni kell, vagyis a / link ne a welcome-ot adja vissza, hanem valamilyen másik blade-et.
Route::get('/', function () {
    return view('welcome');
});


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
