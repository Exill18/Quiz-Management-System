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
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/update-field', [UserController::class, 'updateField'])->name('users.updateField');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::patch('/users/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');

});

