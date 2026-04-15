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

    .stats-row {
        display: flex; gap: 12px; margin-bottom: 20px;
    }
    .stat-box {
        flex: 1; background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px; padding: 16px;
        text-align: center;
    }
    .stat-box .stat-num { font-size: 28px; font-weight: 700; color: #68c3ff; }
    .stat-box .stat-label { font-size: 12px; color: #9fb0cb; margin-top: 4px; }

    .cq-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 24px 28px;
        margin-bottom: 16px;
        border-left: 5px solid #68c3ff;
    }
    .cq-card h2 { font-size: 17px; font-weight: 700; margin: 0 0 6px; color: #eaf1fc; }
    .cq-card p { font-size: 14px; color: #9fb0cb; margin: 4px 0; }

    .score-pill {
        display: inline-block;
        padding: 3px 12px; border-radius: 20px;
        font-size: 13px; font-weight: 700;
    }
    .score-high { background: rgba(80,255,150,0.15); color: #50ff96; }
    .score-mid { background: rgba(255,200,0,0.15); color: #ffc800; }
    .score-low { background: rgba(255,80,80,0.15); color: #ff6b6b; }

    .progress-wrap {
        background: rgba(255,255,255,0.08);
        border-radius: 20px; height: 8px;
        margin: 10px 0; overflow: hidden;
    }
    .progress-bar {
        height: 100%; border-radius: 20px;
        transition: width 0.5s ease;
    }
    .progress-high { background: linear-gradient(90deg, #50ff96, #68c3ff); }
    .progress-mid { background: linear-gradient(90deg, #ffc800, #ff9500); }
    .progress-low { background: linear-gradient(90deg, #ff6b6b, #ff4444); }

    .card-footer {
        display: flex; justify-content: space-between;
        align-items: center; margin-top: 12px;
    }
    .btn-retake {
        padding: 6px 16px; border-radius: 8px;
        background: #68c3ff; color: #0d2a52;
        font-weight: 700; font-size: 12px;
        text-decoration: none;
    }
    .result-card {
        background: rgba(104,195,255,0.1);
        border: 1px solid rgba(104,195,255,0.3);
        border-radius: 12px; padding: 24px 28px;
        margin-bottom: 16px; text-align: center;
    }
    .result-card h2 { color: #68c3ff; font-size: 22px; margin-bottom: 8px; }
    .score-big { font-size: 48px; font-weight: 700; color: #68c3ff; }
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
                <h1>🏆 My Scores</h1>
                <p>Your latest quiz results.</p>
            </div>

            {{-- Show result after submitting --}}
            @if(session('result'))
            <div class="result-card">
                <h2>✅ Quiz Completed!</h2>
                <p style="color:#aac4e0;">{{ session('result')['title'] }}</p>
                <div class="score-big">{{ session('result')['score'] }}%</div>
                <p style="color:#9fb0cb;">{{ session('result')['correct'] }} / {{ session('result')['total'] }} correct</p>
                <a href="{{ route('take-quiz') }}" class="btn-retake" style="display:inline-block; margin-top:10px; padding:10px 24px; font-size:14px;">Take Another Quiz</a>
            </div>
            @endif

            {{-- Summary Stats --}}
            @if(count($attempts) > 0)
            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-num">{{ round($attempts->avg('score')) }}%</div>
                    <div class="stat-label">Average Score</div>
                </div>
                <div class="stat-box">
                    <div class="stat-num">{{ $attempts->max('score') }}%</div>
                    <div class="stat-label">Best Score</div>
                </div>
            </div>
            @endif

            {{-- Score Cards --}}
            @forelse($attempts as $attempt)
            <div class="cq-card">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h2>{{ $attempt->quiz->title }}</h2>
                    @if($attempt->score >= 75)
                        <span class="score-pill score-high">{{ $attempt->score }}%</span>
                    @elseif($attempt->score >= 50)
                        <span class="score-pill score-mid">{{ $attempt->score }}%</span>
                    @else
                        <span class="score-pill score-low">{{ $attempt->score }}%</span>
                    @endif
                </div>

                {{-- Progress Bar --}}
                <div class="progress-wrap">
                    <div class="progress-bar {{ $attempt->score >= 75 ? 'progress-high' : ($attempt->score >= 50 ? 'progress-mid' : 'progress-low') }}"
                        style="width: {{ $attempt->score }}%"></div>
                </div>

                <div class="card-footer">
                    <div>
                        <p>✅ Correct: {{ $attempt->correct_answers }} / {{ $attempt->total_questions }}</p>
                        <p style="font-size:12px;">🕐 {{ $attempt->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            @empty
                @if(!session('result'))
                <div class="empty-state">No scores yet. Take a quiz first!</div>
                @endif
            @endforelse
        </div>
    </section>
</div>
@endsection