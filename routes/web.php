<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Home
Route::view('/', 'home')->name('home');

//quizzes
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

// Pricing
Route::view('pricing', 'Pricing.pricing')->name('pricing');
// Payment
Route::post('payment', [PaymentController::class, 'processPayment'])->name('payment');

// Contacts
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');


// Edit User
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'userDash'])->name('users.userDash');
    Route::patch('/users/update-field', [UserController::class, 'updateField'])->name('users.updateField');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');

});


// Quiz Routes
Route::middleware('auth')->group(function () {
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/results', [QuizController::class, 'results'])->name('quizzes.results');
});


// link share quiz

Route::get('/quizzes/{slug}/share', [QuizController::class, 'shared'])->name('quizzes.shared');
Route::post('/quizzes/{slug}/share/submit', [QuizController::class, 'submitSharedQuiz'])->name('quizzes.shared.submit');
