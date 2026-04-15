@extends('layouts.app')

@section('content')
<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
            <div class="sidebar-label">MENU</div>
            <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
            <a class="sidebar-link active-link" href="{{ route('profile.edit') }}">Profile</a>
            <a class="sidebar-link" href="{{ route('settings') }}">Settings</a>
            <a class="sidebar-link" href="{{ route('scores') }}">My Scores</a>
            <a class="sidebar-link" href="{{ route('quiz.index') }}">Manage Quizzes</a>
        </div>

        <div class="sidebar-group">
            <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a>
        </div>
    </aside>

    <section class="dashboard-main glass-panel">
        <div class="dashboard-top">
            <div>
                <h1 class="dashboard-title">Profile</h1>
                <p class="dashboard-subtitle">Manage your account information.</p>
            </div>
        </div>

        <div class="settings-panel">
            @include('profile.partials.update-profile-information-form')
        </div>
    </section>
</div>
@endsection