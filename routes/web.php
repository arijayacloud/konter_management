<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\{AuthCustom, RedirectIfAuthenticatedCustom};
use App\Http\Controllers\PaymentController;

Route::middleware([AuthCustom::class])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/list', [AuthController::class, 'list'])->name('list');
    Route::post('/payments/download', [PaymentController::class, 'downloadMutasi'])->name('download');
    Route::get('/payments/print/{id}', [PaymentController::class, 'print'])->name('print');
    Route::post('/payments', [PaymentController::class, 'create'])->name('create');  // Menyimpan data pembayaran
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('destroy');
    Route::put('/payments', [PaymentController::class, 'update'])->name('update');
    Route::get('/', function () { return view('auth.login'); });
});

Route::middleware([RedirectIfAuthenticatedCustom::class])->group(function(){
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
