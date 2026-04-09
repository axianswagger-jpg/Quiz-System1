<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
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

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/create-quiz', [QuizController::class, 'create'])->name('create-quiz');
    Route::post('/create-quiz', [QuizController::class, 'store'])->name('quiz.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
