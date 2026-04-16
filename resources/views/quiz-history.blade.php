@extends('layouts.app')

@section('content')
<<<<<<< HEAD

<style>
.dashboard-wrap {
    display: flex;
    align-items: flex-start;
    gap: 24px;
}

.sidebar {
    width: 320px;
    flex-shrink: 0;
}

.dashboard-main {
    flex: 1;
    margin-left: 0;
    min-width: 0;
}
</style>
@section('content')
<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
            <div class="sidebar-label">MENU</div>
            <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
            <a class="sidebar-link" href="{{ route('profile.edit') }}">Profile</a>
            <a class="sidebar-link" href="{{ route('settings') }}">Settings</a>
            <a class="sidebar-link" href="{{ route('scores') }}">My Scores</a>
            <a class="sidebar-link" href="{{ route('leaderboard') }}">Leaderboard</a>
            <a class="sidebar-link" href="{{ route('quiz.index') }}">Manage Quizzes</a>
            <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a>
        </div>

        <div class="sidebar-group">
            <div class="sidebar-label"></div>
            
        </div>
    </aside>
=======
>>>>>>> 5f20b0c2d4bd92667a90c5e97c5f037ea9752668
<section class="dashboard-main glass-panel">
    <div class="dashboard-wrap">
        <aside class="glass-panel sidebar">
            <div class="sidebar-group">
                <div class="sidebar-label">MENU</div>
                <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
                <a class="sidebar-link" href="{{ route('profile.edit') }}">Profile</a>
                <a class="sidebar-link" href="{{ route('settings') }}">Settings</a>
                <a class="sidebar-link" href="{{ route('scores') }}">My Scores</a>
                <a class="sidebar-link" href="{{ route('leaderboard') }}">Leaderboard</a>
                <a class="sidebar-link" href="{{ route('quiz.index') }}">Manage Quizzes</a>
            </div>

            <div class="sidebar-group">
                <div class="sidebar-label"></div>
                <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a>
            </div>
        </aside>

        <div class="history-page">
            <h1 class="history-title">Quiz History</h1>
            <p class="history-subtitle">View all your quiz attempts and results.</p>

            <div class="history-list">
                @forelse($attempts as $attempt)
                    <div class="history-card">
                        <div class="history-top">
                            <div>
                                <div class="history-title-text">
                                    {{ optional($attempt->quiz)->title ?? 'Untitled Quiz' }}
                                </div>

                                <p class="history-meta">
                                    Attempt #{{ $attempt->attempt_number }}
                                </p>

                                <p class="history-meta">
                                    Date and Time Taken:
                                    {{ $attempt->created_at ? $attempt->created_at->timezone('Asia/Manila')->format('F d, Y - h:i A') : 'N/A' }}
                                </p>
                            </div>

                            <div class="score-badge score-mid">
                                50%
                            </div>
                        </div>

                        <div class="history-bottom">
                            <div class="history-info">
                                Correct Answers:
                                {{ $attempt->correct_answers ?? 0 }} / {{ $attempt->total_questions ?? 0 }}
                            </div>

                            <a href="/take-quiz/{{ $attempt->quiz->id ?? 0 }}" class="retake-btn">
                                Retake Quiz
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-history">
                        No quiz attempts yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
