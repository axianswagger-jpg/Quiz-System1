@extends('layouts.app')

@section('content')
<style>
.history-card {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 18px;
    padding: 30px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 20px;
    width: 100%;
}

.history-card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transform: translateY(-3px);
}

.history-page {
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    padding: 32px 16px 60px;
    color: white;
}

.history-heading {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 8px;
}

.history-subtitle {
    color: #b8c7e0;
    margin-bottom: 32px;
    font-size: 18px;
}

.progress-bar {
    width: 100%;
    height: 12px;
    background: rgba(255,255,255,0.1);
    border-radius: 999px;
    overflow: hidden;
    margin: 16px 0;
}

.progress-fill {
    height: 100%;
    border-radius: 999px;
}

.progress-high { background: linear-gradient(90deg, #22c55e, #4ade80); }
.progress-mid  { background: linear-gradient(90deg, #eab308, #facc15); }
.progress-low  { background: linear-gradient(90deg, #ef4444, #f87171); }

.score-badge {
    font-size: 22px;
    font-weight: 800;
    padding: 8px 18px;
    border-radius: 12px;
}
.score-high { background: rgba(34,197,94,0.15); color: #4ade80; }
.score-mid  { background: rgba(234,179,8,0.15);  color: #facc15; }
.score-low  { background: rgba(239,68,68,0.15);  color: #f87171; }

.history-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
}

.history-title-text {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 6px;
}

.history-meta {
    color: #b8c7e0;
    font-size: 14px;
    margin: 2px 0;
}

.history-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.history-info {
    color: #d9e4f5;
    font-size: 16px;
    font-weight: 500;
}

.empty-history {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 18px;
    padding: 30px;
    color: #b8c7e0;
    font-size: 18px;
    text-align: center;
}
</style>

<div class="history-page">
    <h1 class="history-heading">📋 Quiz History</h1>
    <p class="history-subtitle">View all your quiz attempts and results.</p>

    <div class="history-list">
        @forelse($attempts as $attempt)
            @php
                $score = $attempt->score ?? (
                    ($attempt->total_questions ?? 0) > 0
                        ? round((($attempt->correct_answers ?? 0) / ($attempt->total_questions ?? 1)) * 100)
                        : 0
                );
                $scoreClass    = $score >= 80 ? 'score-high'    : ($score >= 50 ? 'score-mid'    : 'score-low');
                $progressClass = $score >= 80 ? 'progress-high' : ($score >= 50 ? 'progress-mid' : 'progress-low');
            @endphp

            <div class="history-card">
                <div class="history-top">
                    <div>
                        <div class="history-title-text">{{ optional($attempt->quiz)->title ?? 'Untitled Quiz' }}</div>
                        <p class="history-meta">Attempt #{{ $attempt->attempt_number }}</p>
                        <p class="history-meta">
                            Date: {{ $attempt->created_at ? $attempt->created_at->timezone('Asia/Manila')->format('F d, Y - h:i A') : 'N/A' }}
                        </p>
                    </div>
                    <div class="score-badge {{ $scoreClass }}">{{ $score }}%</div>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill {{ $progressClass }}" style="width: {{ $score }}%;"></div>
                </div>

                <div class="history-bottom">
                    <div class="history-info">
                        Correct Answers: {{ $attempt->correct_answers ?? 0 }} / {{ $attempt->total_questions ?? 0 }}
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-history">No quiz attempts yet.</div>
        @endforelse
    </div>
</div>
@endsection
