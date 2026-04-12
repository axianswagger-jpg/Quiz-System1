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
    .cq-header p { color: #aac4e0; font-size: 15px; margin: 0; }

    .cq-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 24px 28px;
        margin-bottom: 16px;
        border-left: 5px solid #68c3ff;
    }

    .cq-label {
        display: block; font-size: 13px;
        color: #9fb0cb; margin-bottom: 6px; margin-top: 14px;
    }

    .cq-input {
        width: 100%; padding: 11px 14px;
        background: rgba(255,255,255,0.06);
        border: none;
        border-bottom: 2px solid rgba(255,255,255,0.15);
        border-radius: 6px 6px 0 0;
        color: #eaf1fc; font-size: 15px;
        outline: none; font-family: inherit;
    }

    .btn-save {
        margin-top: 20px;
        padding: 10px 28px; border-radius: 8px;
        background: #68c3ff; color: #0d2a52;
        font-weight: 700; font-size: 14px;
        border: none; cursor: pointer;
    }

    .btn-cancel {
        margin-top: 20px; margin-left: 10px;
        padding: 10px 28px; border-radius: 8px;
        background: rgba(255,255,255,0.08);
        color: #aac4e0; font-weight: 700;
        font-size: 14px; border: none;
        cursor: pointer; text-decoration: none;
   {{-- QUESTIONS SECTION --}}
@foreach($quiz->questions as $question)
<div class="cq-card" style="margin-top: 16px;">
    <form action="{{ route('question.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="cq-label">Question</label>
        <input class="cq-input" type="text" name="question_text" value="{{ $question->question_text }}" required>

        @foreach($question->options as $option)
        <label class="cq-label">Option</label>
        <div style="display:flex; align-items:center; gap:10px;">
            <input class="cq-input" type="text" name="options[{{ $option->id }}]" value="{{ $option->option_text }}" required>
            <input type="radio" name="correct" value="{{ $option->id }}" {{ $option->is_correct ? 'checked' : '' }}>
        </div>
        @endforeach

        <button type="submit" class="btn-save" style="margin-top:14px;">Save Question</button>
    </form>

    {{-- DELETE QUESTION --}}
    <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete" onclick="return confirm('Delete this question?')" style="margin-top:10px;">Delete Question</button>
    </form>
</div>
@endforeach
   
   
   }
</style>

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
        <div class="cq-wrap">
            <div class="cq-header">
                <h1>✏️ Edit Quiz</h1>
                <p>Update your quiz details below.</p>
            </div>

            <div class="cq-card">
                <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="cq-label">Quiz Title</label>
                    <input class="cq-input" type="text" name="title" value="{{ $quiz->title }}" required>

                    <label class="cq-label">Description</label>
                    <textarea class="cq-input" name="description" rows="3">{{ $quiz->description }}</textarea>

                    <br>
                    <button type="submit" class="btn-save">Update Quiz</button>
                    <a href="{{ route('quiz.index') }}" class="btn-cancel">Cancel</a>
             
            </form>
            {{-- QUESTIONS SECTION --}}
            @foreach($quiz->questions as $question)
            <div class="cq-card" style="margin-top: 16px;">
                <form action="{{ route('question.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="cq-label">Question</label>
                    <input class="cq-input" type="text" name="question_text" value="{{ $question->question_text }}" required>

                    @foreach($question->options as $option)
                    <label class="cq-label">Option</label>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <input class="cq-input" type="text" name="options[{{ $option->id }}]" value="{{ $option->option_text }}" required>
                        <input type="radio" name="correct" value="{{ $option->id }}" {{ $option->is_correct ? 'checked' : '' }}>
                    </div>
                    @endforeach

                    <button type="submit" class="btn-save" style="margin-top:14px;">Save Question</button>
                </form>

                <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('Delete this question?')" style="margin-top:10px;">Delete Question</button>
                </form>
            </div>
            @endforeach
            </div>
        </div>
    </section>
</div>
@endsection