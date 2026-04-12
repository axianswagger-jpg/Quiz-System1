<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'totalQuizzes'     => \App\Models\Quiz::count(),
            'completedQuizzes' => \App\Models\Attempt::where('user_id', auth()->id())->count(),
            'avgScore'         => round(\App\Models\Attempt::where('user_id', auth()->id())->avg('score') ?? 0),
        ]);
    })->name('dashboard');

    // Quiz History
    Route::get('/quiz-history', function () {
        return view('quiz-history');
    })->name('quiz-history');

    // Settings
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    // Quiz CRUD
    Route::get('/create-quiz', [QuizController::class, 'create'])->name('create-quiz');
    Route::post('/create-quiz', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quizzes/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quizzes/{id}', [QuizController::class, 'update'])->name('quiz.update');
    Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');

    // Question CRUD
    Route::delete('/questions/{id}', [QuizController::class, 'destroyQuestion'])->name('question.destroy');
    Route::put('/questions/{id}', [QuizController::class, 'updateQuestion'])->name('question.update');

    // Take Quiz
    Route::get('/take-quiz', [QuizController::class, 'takeQuizList'])->name('take-quiz');
    Route::get('/take-quiz/{id}', [QuizController::class, 'takeQuiz'])->name('take-quiz.show');
    Route::post('/take-quiz/{id}', [QuizController::class, 'submitQuiz'])->name('take-quiz.submit');

    // Scores
    Route::get('/scores', [QuizController::class, 'scores'])->name('scores');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';