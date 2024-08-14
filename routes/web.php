<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')
    ->name('home');
// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'user-access'])
    ->name('dashboard');

Route::middleware(['auth', 'user-access'])->group(function () {
    Route::view('profile', 'profile')
        ->name('profile');
});


// Admin
Route::get('admin/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'admin-access'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'admin-access'])
->prefix('admin')->name('admin.')
->middleware(['auth', 'admin-access'])
->group(function () {
});

require __DIR__.'/auth.php';
