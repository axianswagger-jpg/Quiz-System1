@extends('layouts.app')

@section('content')
<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
    <div class="sidebar-label">MENU</div>
    <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
    <a class="sidebar-link" href="{{ route('profile.edit') }}">Profile</a>    <a class="sidebar-link" href="{{ route('settings') }}">Settings</a>
    <a class="sidebar-link" ...>My Scores</a>
   <a class="sidebar-link" href="{{ route('quiz.index') }}">Manage Quizzes</a>

</div>

<div class="sidebar-group">
    <div class="sidebar-label"></div>
    <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a></div>
    </aside>

    <section class="dashboard-main glass-panel">
        <div class="dashboard-top">
            <div>
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Welcome back. Here is your quiz overview.</p>
            </div>

            <div class="dashboard-top-right">
                <span class="user-pill">Student / Admin</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Available Quizzes</h3>
                <div class="stat-number">0</div>
                <p>No quizzes yet</p>
            </div>
            <div class="stat-card">
                <h3>Completed Quizzes</h3>
                <div class="stat-number">0</div>
                <p>No attempts yet</p>
            </div>
            <div class="stat-card">
                <h3>Average Score</h3>
                <div class="stat-number">0%</div>
                <p>No scores yet</p>
            </div>
            <div class="stat-card">
                <h3> Rank</h3>
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
                <div class="feature-item">🏆 Check  and recent activity</div>
            </div>

            <div class="large-card">
                <h2>Quick Actions</h2>
                <p>Common pages you can open right away.</p>

                <a class="sidebar-link" href="#">Start New Quiz</a>
                <a class="sidebar-link" href="#">View My Scores</a>
                <a class="sidebar-link" href="#">Open </a>
                <a class="btn btn-primary btn-full" href="#">Go to Reports</a>
            </div>
        </div>
    </section>
</div>
@endsection
