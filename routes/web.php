<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;

use App\Http\Controllers\SettingsController;

use App\Http\Controllers\AttemptController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

Route::get('/leaderboard', [AttemptController::class, 'leaderboard'])->name('leaderboard');
    // Dashboard
    Route::get('/dashboard', function () {
    $userId = auth()->id();

    $totalQuizzes = \App\Models\Quiz::count();
    $completedQuizzes = \App\Models\Attempt::where('user_id', $userId)->count();
    $avgScore = round(\App\Models\Attempt::where('user_id', $userId)->avg('score') ?? 0);

    $leaderboard = \App\Models\Attempt::selectRaw('user_id, AVG(score) as avg_score')
        ->groupBy('user_id')
        ->orderByDesc('avg_score')
        ->get()
        ->values();

    $rank = null;

    foreach ($leaderboard as $index => $entry) {
        if ($entry->user_id == $userId) {
            $rank = $index + 1;
            break;
        }
    }

    return view('dashboard', compact(
        'totalQuizzes',
        'completedQuizzes',
        'avgScore',
        'rank'
    ));
})->name('dashboard');

    // Quiz History
    Route::get('/quiz-history', [AttemptController::class, 'history'])->name('quiz-history');

    // Settings
Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/security', function () {
    return view('settings.security');
})->name('settings.security');

Route::patch('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');

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

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Leaderboard
    
    

});

require __DIR__ . '/auth.php';