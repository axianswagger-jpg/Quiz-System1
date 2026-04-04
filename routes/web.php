<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/take-quiz', function () {
    return view('take-quiz');
})->name('take-quiz');

Route::get('/scores', function () {
    return view('scores');
})->name('scores');

Route::get('/quiz-history', function () {
    return view('quiz-history');
})->name('quiz-history');

Route::get('/leaderboard', function () {
    return view('leaderboard');
})->name('leaderboard');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/create-quiz', function () {
    return view('create-quiz');
})->name('create-quiz');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/take-quiz', function () {
    return view('take-quiz');
})->name('take-quiz');

Route::get('/scores', function () {
    return view('scores');
})->name('scores');

Route::get('/quiz-history', function () {
    return view('quiz-history');
})->name('quiz-history');

Route::get('/leaderboard', function () {
    return view('leaderboard');
})->name('leaderboard');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/create-quiz', function () {
    return view('create-quiz');
})->name('create-quiz');