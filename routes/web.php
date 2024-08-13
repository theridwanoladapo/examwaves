<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


// Admin
Route::get('admin/dashboard', [HomeController::class, 'index'])
    ->name('admin');

require __DIR__.'/auth.php';
