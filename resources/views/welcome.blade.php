@extends('layouts.app')

@section('content')
<div class="hero-wrap">
    <section class="glass-panel hero-panel">
        <div class="hero-center">
            <h1 class="hero-title">Welcome to Quiz System 🎓</h1>
            <p class="hero-subtitle">Test your knowledge, track your attempts, and improve your skills.</p>

            <div class="pill-row">
                <span class="feature-pill">🧠 Smart Practice</span>
                <span class="feature-pill">⏱️ Timed Quizzes</span>
                <span class="feature-pill">📊 Progress Tracking</span>
                <span class="feature-pill">🏆 Leaderboards</span>
            </div>

            <div class="button-row">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="info-icon">⚡</div>
                <h3>Instant Feedback</h3>
                <p>Know your score right away and learn faster.</p>
            </div>

            <div class="info-card">
                <div class="info-icon">🗂️</div>
                <h3>Categories</h3>
                <p>Organized quizzes by topic and difficulty.</p>
            </div>

            <div class="info-card">
                <div class="info-icon">📈</div>
                <h3>Track Progress</h3>
                <p>See your improvement over time and streaks.</p>
            </div>
        </div>
    </section>
</div>
@endsection