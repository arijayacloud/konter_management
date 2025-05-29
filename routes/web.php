<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/list', function () {
    return view('list');
})->name('list');
