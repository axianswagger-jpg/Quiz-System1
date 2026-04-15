@extends('layouts.app')

@section('content')
<style>
    .cq-wrap { max-width: 720px; margin: 0 auto; padding: 32px 16px 60px; }

    .cq-header {
        background: linear-gradient(135deg, #1a3a6b, #0d2a52);
        border-radius: 16px 16px 0 0;
        border-top: 8px solid #68c3ff;
        padding: 28px 32px;
        margin-bottom: 0;
    }
    .cq-header h1 { font-size: 32px; font-weight: 700; margin: 0 0 6px; color: #fff; }
    .cq-header p { color: #aac4e0; font-size: 15px; margin: 0; }

    .cq-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 24px 28px;
        margin-bottom: 16px;
        border-left: 5px solid #68c3ff;
    }

    .cq-card h2 { font-size: 17px; font-weight: 700; margin: 0 0 6px; color: #eaf1fc; }
    .cq-card p { font-size: 14px; color: #9fb0cb; margin: 0; }

    .cq-actions { display: flex; gap: 10px; margin-top: 14px; }

    .btn-edit {
        padding: 7px 18px; border-radius: 8px;
        background: #68c3ff; color: #0d2a52;
        font-weight: 700; font-size: 13px;
        text-decoration: none;
    }

    .btn-delete {
        padding: 7px 18px; border-radius: 8px;
        background: rgba(255,80,80,0.15);
        border: 1px solid rgba(255,80,80,0.4);
        color: #ff6b6b; font-weight: 700;
        font-size: 13px; cursor: pointer;
    }

    .alert-success {
        background: rgba(80,255,150,0.1);
        border: 1px solid rgba(80,255,150,0.3);
        color: #50ff96; padding: 12px 18px;
        border-radius: 10px; margin-bottom: 16px;
    }

    .empty-state { text-align: center; color: #9fb0cb; padding: 40px; }
</style>

<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
            <div class="sidebar-label">MENU</div>
            <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
            <a class="sidebar-link" href="{{ route('profile.edit') }}">Profile</a>
            <a class="sidebar-link" href="{{ route('settings.edit') }}">Settings</a>
            <a class="sidebar-link" href="{{ route('scores') }}">My Scores</a>
            <a class="sidebar-link" href="{{ route('quiz.index') }}">Manage Quizzes</a>
        </div>
        <div class="sidebar-group">
            <div class="sidebar-label"></div>
            <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a>
        </div>
    </aside>

    <section class="dashboard-main glass-panel">
        <div class="cq-wrap">
            <div class="cq-header">
                <h1>📋 My Quizzes</h1>
                <p>Manage your created quizzes.</p>
            </div>
            <br>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @forelse($quizzes as $quiz)
            <div class="cq-card">
                <h2>{{ $quiz->title }}</h2>
                <p>{{ $quiz->description ?? 'No description provided.' }}</p>
                <div class="cq-actions">
                    <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Delete this quiz?')">Delete</button>
                    </form>
                </div>
            </div>
            @empty
                <div class="empty-state">No quizzes yet. <a href="{{ route('create-quiz') }}">Create one!</a></div>
            @endforelse
        </div>
    </section>
</div>
@endsection