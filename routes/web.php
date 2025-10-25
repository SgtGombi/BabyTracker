<?php

use Illuminate\Support\Facades\Route;

// CSIMBI: ezt törölni kell, vagyis a / link ne a welcome-ot adja vissza, hanem valamilyen másik blade-et.
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [\App\Http\Controllers\admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\admin\LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [\App\Http\Controllers\admin\LoginController::class, 'logout'])->name('admin.logout');
});
