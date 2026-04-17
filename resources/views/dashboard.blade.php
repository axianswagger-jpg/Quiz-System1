@extends('layouts.app')

@section('content')
<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
            <div class="sidebar-label">MENU</div>
            <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
            <a class="sidebar-link" href="{{ route('profile.edit') }}">Profile</a>
           <a class="sidebar-link" href="{{ route('settings') }}">Settings</a>
           <a class="sidebar-link" href="{{ route('scores') }}">My Scores</a>
            <a class="sidebar-link" href="{{ route('quiz.index') }}">Manage Quizzes</a>
        </div>

        <div class="sidebar-group">
            <div class="sidebar-label"></div>
            <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a>
        </div>
    </aside>

    <section class="dashboard-main glass-panel">
        <div class="dashboard-top">
            <div>
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Welcome back. Here is your quiz overview.</p>
            </div>

            <div class="dashboard-top-right">
               <a href="{{ route('profile.edit') }}" class="user-pill">
    {{ auth()->user()->name ?? 'User' }}
</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div style="
                background: rgba(74,222,128,0.1);
                border: 1px solid rgba(74,222,128,0.3);
                color: #4ade80;
                padding: 12px 16px;
                border-radius: 10px;
                margin-bottom: 16px;
                font-size: 14px;
            ">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Available Quizzes</h3>
                <div class="stat-number">{{ $totalQuizzes ?? 0 }}</div>
                <p>{{ ($totalQuizzes ?? 0) > 0 ? 'Quizzes ready to take' : 'No quizzes yet' }}</p>
            </div>
            <div class="stat-card">
                <h3>Completed Quizzes</h3>
                <div class="stat-number">{{ $completedQuizzes ?? 0 }}</div>
                <p>{{ ($completedQuizzes ?? 0) > 0 ? 'Quizzes attempted' : 'No attempts yet' }}</p>
            </div>
            <div class="stat-card">
                <h3>Average Score</h3>
                <div class="stat-number">{{ $avgScore ?? 0 }}%</div>
                <p>{{ ($avgScore ?? 0) > 0 ? 'Keep it up!' : 'No scores yet' }}</p>
            </div>
            <div class="stat-card">
                <h3>Rank</h3>
                <div class="stat-number">-</div>
                <p>No ranking yet</p>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="large-card">
                <h2>Stay on track ✨</h2>
                <p>Monitor your progress, check updates, and continue your quiz journey with a clean and modern dashboard.</p>

                <div class="feature-item">📚 View available quizzes anytime</div>
                <div class="feature-item">📈 Track scores and performance easily</div>
                <div class="feature-item">🏆 Check your recent activity</div>
            </div>

            <div class="large-card">
                <h2>Quick Actions</h2>
                <p>Common pages you can open right away.</p>

                <a class="sidebar-link" href="{{ route('take-quiz') }}">Start New Quiz</a>
                <a class="sidebar-link" href="{{ route('scores') }}">View My Scores</a>
                <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
                <a class="btn btn-primary btn-full" href="{{ route('quiz.index') }}">Manage Quizzes</a>
            </div>
        </div>
    </section>
</div>
@endsection
