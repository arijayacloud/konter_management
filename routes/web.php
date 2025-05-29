<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });
// Route::view('/login', 'auth.login');
// Route::view('/register', 'auth.register');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
//
// Route::get('/list', function () {
//     return view('list');
// })->name('list');

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthCustom;

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/logout', [AuthController::class, 'logout'])->middleware(AuthCustom::class)->name('logout');

    // Protected route
    // Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware(AuthCustom::class)->name('dashboard');
    Route::get('/list', [AuthController::class, 'list'])->middleware(AuthCustom::class)->name('list');
