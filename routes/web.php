<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $exams = \App\Models\Exam::limit(6)->get();
    $certifications = \App\Models\Certification::limit(6)->get();

    return view('home', compact(['exams','certifications']));
})
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
->group(function () {
    Route::get('exams', [ExamController::class, 'index'])
        ->name('exams.index');
    Route::get('exams/create', [ExamController::class, 'create'])
        ->name('exams.create');
    Route::get('exams/view/{id}', [ExamController::class, 'show'])
        ->name('exams.view');
    Route::get('exams/edit/{id}', [ExamController::class, 'edit'])
        ->name('exams.edit');

    Route::get('certifications', [CertificationController::class, 'index'])
        ->name('certifications.index');
    Route::get('certifications/create', [CertificationController::class, 'create'])
        ->name('certifications.create');
    Route::get('certifications/view/{id}', [CertificationController::class, 'show'])
        ->name('certifications.view');
    Route::get('certifications/edit/{id}', [CertificationController::class, 'edit'])
        ->name('certifications.edit');
});

require __DIR__.'/auth.php';
