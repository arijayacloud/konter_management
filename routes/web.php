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
use App\Http\Middleware\{AuthCustom, RedirectIfAuthenticatedCustom};

Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware(RedirectIfAuthenticatedCustom::class)->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->middleware(RedirectIfAuthenticatedCustom::class)->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware(RedirectIfAuthenticatedCustom::class)->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->middleware(RedirectIfAuthenticatedCustom::class)->name('login');


Route::post('/logout', [AuthController::class, 'logout'])->middleware(AuthCustom::class)->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware(AuthCustom::class)->name('dashboard');
Route::get('/list', [AuthController::class, 'list'])->middleware(AuthCustom::class)->name('list');

use App\Http\Controllers\PaymentController;

Route::post('/payments', [PaymentController::class, 'create'])->middleware(AuthCustom::class)->name('create');  // Menyimpan data pembayaran
Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->middleware(AuthCustom::class)->name('destroy');

