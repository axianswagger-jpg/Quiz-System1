<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// LOGIN PAGE (design only)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.page');

// REGISTER PAGE (design only)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.page');

// DASHBOARD (no database)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// LOGOUT (design only)
Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');