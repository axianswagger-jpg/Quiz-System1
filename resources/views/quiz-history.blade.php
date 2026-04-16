@extends('layouts.quiz')
@extends('layouts.app')

@section('content')

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
<section class="dashboard-main glass-panel">
<style>
    .history-page {
        padding: 30px;
        color: white;
    }

    .history-title {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .history-subtitle {
        color: #b8c7e0;
        margin-bottom: 30px;
        font-size: 16px;
    }

    .history-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .history-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.18);
    }

    .history-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 16px;
    }

    .history-title-text {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .history-meta {
        color: #b8c7e0;
        margin: 4px 0;
        font-size: 14px;
    }

    .score-badge {
        padding: 10px 18px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 16px;
        min-width: 90px;
        text-align: center;
    }

    .score-high {
        background: rgba(34, 197, 94, 0.18);
        color: #4ade80;
    }

    .score-mid {
        background: rgba(250, 204, 21, 0.18);
        color: #facc15;
    }

    .score-low {
        background: rgba(239, 68, 68, 0.18);
        color: #f87171;
    }

    .progress-bar {
        width: 100%;
        height: 12px;
        background: rgba(255,255,255,0.08);
        border-radius: 999px;
        overflow: hidden;
        margin: 18px 0;
    }

    .progress-fill {
        height: 100%;
        border-radius: 999px;
    }

    .progress-high {
        background: linear-gradient(90deg, #22c55e, #4ade80);
    }

    .progress-mid {
        background: linear-gradient(90deg, #eab308, #facc15);
    }

    .progress-low {
        background: linear-gradient(90deg, #ef4444, #f87171);
    }

    .history-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .history-info {
        color: #d9e4f5;
        font-size: 15px;
        font-weight: 500;
    }

    .retake-btn {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 12px;
        background: #67c7ff;
        color: #082544;
        text-decoration: none;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .retake-btn:hover {
        transform: translateY(-1px);
        opacity: 0.95;
    }

    .empty-history {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        padding: 24px;
        color: #b8c7e0;
    }
</style>

<div class="history-page">
    <h1 class="history-title">Quiz History</h1>
    <p class="history-subtitle">View all your quiz attempts and results.</p>

    <div class="history-list">
        @forelse($attempts as $attempt)
            @php
                $score = $attempt->score ?? (
                    ($attempt->total_questions ?? 0) > 0
                        ? round((($attempt->correct_answers ?? 0) / $attempt->total_questions) * 100)
                        : 0
                );

                $scoreClass = $score >= 80 ? 'score-high' : ($score >= 50 ? 'score-mid' : 'score-low');
                $progressClass = $score >= 80 ? 'progress-high' : ($score >= 50 ? 'progress-mid' : 'progress-low');
            @endphp

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
                        </p>
                    </div>

                    <div class="score-badge {{ $scoreClass }}">
                        {{ $score }}%
                    </div>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill {{ $progressClass }}" style="width: {{ $score }}%;"></div>
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
  </section>
</div>
@endsection