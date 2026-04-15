@extends('layouts.quiz')

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
    .btn-take {
        margin-top: 12px;
        padding: 8px 20px; border-radius: 8px;
        background: #68c3ff; color: #0d2a52;
        font-weight: 700; font-size: 13px;
        text-decoration: none; display: inline-block;
    }
    .empty-state { text-align: center; color: #9fb0cb; padding: 40px; }
</style>
        <div class="cq-wrap">
            <div class="cq-header">
                <h1>📝 Available Quizzes</h1>
                <p>Select a quiz to start.</p>
            </div>

            @forelse($quizzes as $quiz)
            <div class="cq-card">
                <h2>{{ $quiz->title }}</h2>
                <p>{{ $quiz->description ?? 'No description.' }} &nbsp;|&nbsp; {{ $quiz->questions_count }} questions</p>
                <a href="{{ route('take-quiz.show', $quiz->id) }}" class="btn-take">Start Quiz</a>
            </div>
            @empty
                <div class="empty-state">No quizzes available yet.</div>
            @endforelse
        </div>
@endsection