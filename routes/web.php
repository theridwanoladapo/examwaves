<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $exams = \App\Models\Exam::limit(6)->get();
    $certifications = \App\Models\Certification::limit(6)->get();

    return view('home', compact(['exams','certifications']));
})->name('home');

Route::get('providers', [HomeController::class, 'allProviders'])
    ->name('providers');
Route::get('providers/{id}', [HomeController::class, 'viewProvider'])
    ->name('providers.view');

Route::view('exams', 'exams.index')
    ->name('certifications');
Route::get('exams/{id}', [HomeController::class, 'viewExam'])
    ->name('certifications.view');

Route::view('user/dashboard', 'user.dashboard')
    ->middleware(['auth', 'verified', 'user-access'])
    ->name('dashboard');

Route::middleware(['auth', 'user-access'])->group(function () {
    Route::view('user/profile', 'user.profile')
        ->name('profile');
    Route::view('user/settings', 'user.settings')
        ->name('settings');
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

    Route::get('tests/index', [TestController::class, 'index'])
        ->name('tests.index');
    Route::get('tests/create', [TestController::class, 'create'])
        ->name('tests.create');
    Route::get('tests/view/{id}', [TestController::class, 'show'])
        ->name('tests.view');

    Route::get('questions/upload', [QuestionController::class, 'upload'])
        ->name('questions.upload');
    Route::get('questions/create', [QuestionController::class, 'create'])
        ->name('questions.create');
});

require __DIR__.'/auth.php';
