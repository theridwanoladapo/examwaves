<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }
    $exams = \App\Models\Exam::where('isMenu', true)->limit(6)->get();
    $certifications = \App\Models\Certification::limit(6)->get();

    return view('homepage', compact(['exams','certifications']));
})->middleware(['check-suspended'])
->name('home');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Route::get('/about-us', function () {
    return view('about');
})->name('about');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');
Route::get('/request-exam', function () {
    return view('request-exam');
})->name('request-exam');


Route::get('/providers', [HomeController::class, 'allProviders'])
    ->name('providers');
Route::get('/providers/{id}', [HomeController::class, 'viewProvider'])
    ->name('providers.view');

Route::get('/exams', [HomeController::class, 'allExams'])
    ->name('certifications');
Route::get('/exams/{id}', [HomeController::class, 'viewExam'])
    ->name('certifications.view');

// UserAccess
Route::middleware(['auth', 'verified', 'user-access'])
->get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');
// Route::view('/user/dashboard', 'user.dashboard')
//     ->middleware(['auth', 'verified', 'user-access'])
//     ->name('dashboard');

Route::middleware(['auth', 'verified', 'user-access'])
->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'profile'])
        ->name('profile');
    Route::get('/user/profile/edit', [ProfileController::class, 'profileEdit'])
        ->name('profile.edit');
    Route::get('/user/settings', [ProfileController::class, 'settings'])
        ->name('settings');

    Route::get('/user/exams', [ProfileController::class, 'exams'])
        ->name('exams');
    Route::get('/user/exam/{id}', [ProfileController::class, 'exam'])
        ->name('exam');
    Route::get('/user/exam/{id}/quiz/{test_id}', [ProfileController::class, 'tryQuiz'])
        ->name('exam.quiz');

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart');
});

Route::get('/paypal/checkout', [PayPalController::class, 'checkout'])->name('paypal.checkout');
Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');

Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment.callback');
Route::post('/webhook', [PaymentController::class, 'handleWebhook']);


// AdminAccess
Route::get('/admin/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'admin-access'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'admin-access'])
->prefix('admin')->name('admin.')
->group(function () {
    Route::get('/exams', [ExamController::class, 'index'])
        ->name('exams.index');
    Route::get('/exams/create', [ExamController::class, 'create'])
        ->name('exams.create');
    Route::get('/exams/view/{id}', [ExamController::class, 'show'])
        ->name('exams.view');
    Route::get('/exams/edit/{id}', [ExamController::class, 'edit'])
        ->name('exams.edit');

    Route::get('/certifications', [CertificationController::class, 'index'])
        ->name('certifications.index');
    Route::get('/certifications/create', [CertificationController::class, 'create'])
        ->name('certifications.create');
    Route::get('/certifications/view/{id}', [CertificationController::class, 'show'])
        ->name('certifications.view');
    Route::get('/certifications/edit/{id}', [CertificationController::class, 'edit'])
        ->name('certifications.edit');

    Route::get('/tests', [TestController::class, 'index'])
        ->name('tests.index');
    Route::get('/tests/create', [TestController::class, 'create'])
        ->name('tests.create');
    Route::get('/tests/view/{id}', [TestController::class, 'show'])
        ->name('tests.view');
    Route::get('/tests/edit/{id}', [TestController::class, 'edit'])
        ->name('tests.edit');
    Route::get('/tests/quiz/{id}', [TestController::class, 'tryQuiz'])
        ->name('tests.quiz');

    Route::get('/questions/upload', [QuestionController::class, 'upload'])
        ->name('questions.upload');
    Route::get('/questions/create', [QuestionController::class, 'create'])
        ->name('questions.create');
    Route::get('/questions/edit/{id}', [QuestionController::class, 'edit'])
        ->name('questions.edit');

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('/users/view/{id}', [UserController::class, 'show'])
        ->name('users.view');
});

require __DIR__.'/auth.php';
