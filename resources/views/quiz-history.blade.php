@extends('layouts.app')

@section('content')

<style>
.dashboard-wrap {
    display: flex;
    min-height: 100vh;
    width: 100%;
    background: #03163d; /* Dark background color for the page */
}

.sidebar {
    width: 280px;
    flex-shrink: 0;
    position: sticky;
    top: 0;
    height: 100vh;
    z-index: 100;
    margin-left: 0;
    padding-left: 0;
    background-color: #03163d;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    position: fixed !important;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    padding: 110px 22px 22px 22px;
    overflow-y: auto;
    z-index: 1000;
}
.history-card {
    background: rgba(255, 255, 255, 0.08);  /* Background for each card */
    border: 1px solid rgba(255, 255, 255, 0.12);  /* Border for the card */
    border-radius: 18px;  /* Rounded corners */
    padding: 30px;  /* Padding inside the card */
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);  /* Shadow effect */
    transition: transform 0.3s ease, box-shadow 0.3s ease;  /* Hover effect */
    margin-bottom: 30px;  /* Margin between the cards */
    width: 100%;  /* Cards will fill the available space */
}

.history-title {
 margin-bottom: 40px;  /* Remove extra margin below */
    height: auto;  /* Adjust height automatically based on content */
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 22px;
     
font-size: 48px;  /* Larger font size for the title */
    font-weight: 800;
    margin-bottom: 40px;  /* Space below the title */
    background: rgba(255, 255, 255, 0.08);  /* Card-like background */
    border: 1px solid rgba(255, 255, 255, 0.12);  /* Soft border */
    border-radius: 18px;  /* Rounded corners for the title container */
    padding: 30px;  /* Add more padding inside the title container */
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);  /* Shadow for floating effect */
    width: 100%;  /* Make it fill the entire width of the page */
    text-align: center;  /* Center the text */
   
}

/* Add a subtle hover effect for the title container */
.history-title {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);  /* Bigger shadow on hover */
    transform: translateY(-5px);  /* Slight elevation on hover */
}

.dashboard-main {
    flex: 1;
    min-width: 0;
    display: flex;
    justify-content: center;
    padding: 40px 20px;
}

.history-page {
    width: 100%;
    max-width: 1000px;
    color: white;
}

/* Cards Styling */
.history-card {
    background: rgba(255, 255, 255, 0.08);  /* Lighter background for the cards */
    border: 1px solid rgba(255, 255, 255, 0.12);  /* Subtle border for the cards */
    border-radius: 18px;  /* Rounded corners for the cards */
    padding: 30px;  /* Padding to make the card more spacious */
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);  /* Shadow for a card-like appearance */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.history-card {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);  /* Hover effect with shadow */
    transform: translateY(-5px);  /* Slight elevation on hover */
}

/
.history-title {
    font-size: 48px;  /* Larger title */
    font-weight: 800;
    margin-bottom: 15px;  /* More space below the title */
}

.history-subtitle {
    color: #b8c7e0;
    margin-bottom: 40px;  /* More space below the subtitle */
    font-size: 18px;  /* Increased font size for readability */
}

/* Progress Bar */
.progress-bar {
    width: 100%;
    height: 16px;  /* Increased height for more visibility */
    background: rgba(255,255,255,0.1);
    border-radius: 999px;
    overflow: hidden;
    margin: 20px 0;  /* More margin between elements */
}

.progress-fill {
    height: 100%;
    border-radius: 999px;
}

.progress-high {
    background: linear-gradient(90deg, #22c55e, #4ade80);
}

.progress-mid {
    background: linear-gradient(90deg, #eab308, #facc15);
}

.progress-low {
    background: linear-gradient(90deg, #ef4444, #f87171);
}

/* Bottom Section - Correct Answers & Retake Button */
.history-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.history-info {
    color: #d9e4f5;
    font-size: 18px;  /* Larger font size for better readability */
    font-weight: 500;
}



/* Empty History Section - Message when no attempts are found */
.empty-history {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 18px;
    padding: 30px;
    color: #b8c7e0;
    font-size: 18px;
}

</style>

<div class="dashboard-wrap">
    {{-- Sidebar --}}
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
            <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a>
        </div>
    </aside>

    {{-- Main Content Section --}}
    <section class="dashboard-main">
        <div class="history-page">
            <h1 class="history-title">Quiz History</h1>
            <p class="history-subtitle">View all your quiz attempts and results.</p>

            <div class="history-list">
                @forelse($attempts as $attempt)
                    @php
                        $score = $attempt->score ?? (
                            ($attempt->total_questions ?? 0) > 0
                                ? round((($attempt->correct_answers ?? 0) / ($attempt->total_questions ?? 1)) * 100)
                                : 0
                        );

                        $scoreClass = $score >= 80 ? 'score-high' : ($score >= 50 ? 'score-mid' : 'score-low');
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
    </section>
</div>

@endsection