@extends('layouts.app')

@section('content')
<style>
    .cq-wrap { max-width: 720px; margin: 0 auto; padding: 32px 16px 60px; }
    .cq-header {
        background: linear-gradient(135deg, #1a3a6b, #0d2a52);
        border-radius: 16px 16px 0 0;
        border-top: 8px solid #68c3ff;
        padding: 28px 32px;
        margin-bottom: 16px;
    }
    .cq-header h1 { font-size: 32px; font-weight: 700; margin: 0 0 6px; color: #fff; }
    .cq-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 24px 28px;
        margin-bottom: 16px;
        border-left: 5px solid #68c3ff;
    }
    .cq-card h3 { font-size: 16px; font-weight: 700; color: #eaf1fc; margin-bottom: 14px; }
    .option-label {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px; border-radius: 8px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        color: #eaf1fc; font-size: 14px;
        cursor: pointer; margin-bottom: 8px;
    }
    .option-label:hover { background: rgba(104,195,255,0.1); }
    .btn-submit {
        padding: 12px 32px; border-radius: 8px;
        background: #68c3ff; color: #0d2a52;
        font-weight: 700; font-size: 15px;
        border: none; cursor: pointer; margin-top: 10px;
    }
</style>

<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
            <div class="sidebar-label">MENU</div>
            <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
            <a class="sidebar-link" href="{{ route('profile.edit') }}">Profile</a>
            <a class="sidebar-link" href="{{ route('settings') }}">Settings</a>
            <a class="sidebar-link" href="#">My Scores</a>
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
                <h1>📝 {{ $quiz->title }}</h1>
            </div>

            <form action="{{ route('take-quiz.submit', $quiz->id) }}" method="POST">
                @csrf
                @foreach($quiz->questions as $index => $question)
                <div class="cq-card">
                    <h3>{{ $index + 1 }}. {{ $question->question_text }}</h3>
                    @foreach($question->options as $option)
                    <label class="option-label">
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" required>
                        {{ $option->option_text }}
                    </label>
                    @endforeach
                </div>
                @endforeach

                <button type="submit" class="btn-submit">Submit Quiz</button>
            </form>
        </div>
    </section>
</div>
@endsection