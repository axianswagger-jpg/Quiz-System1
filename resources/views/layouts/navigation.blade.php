<nav class="topbar">
    <div class="brand">
        <div class="brand-badge">?</div>
        <div>
            <div class="brand-title">Quiz System</div>
            <div class="brand-subtitle">Learn • Practice • Improve</div>
        </div>
    </div>

    <div class="topbar-right">
        <span class="version-pill">v1</span>

        @auth
            <span class="user-pill">{{ Auth::user()?->name }}</span>

            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        @endauth
    </div>
</nav>
<div class="menu">
    <a href="{{ route('dashboard') }}" class="sidebar-link">Dashboard</a>
    <a href="{{ route('take-quiz') }}" class="sidebar-link">Take Quiz</a>
    <a href="{{ route('scores') }}" class="sidebar-link">My Scores</a>
    <a href="{{ route('quiz-history') }}" class="sidebar-link">Quiz History</a>
    <a href="{{ route('leaderboard') }}" class="sidebar-link">Leaderboard</a>
    <a href="{{ route('profile') }}" class="sidebar-link">Profile</a>
    <a href="{{ route('settings.edit') }}" class="sidebar-link">Settings</a>
    <a href="{{ route('create-quiz') }}" class="sidebar-link">Create Quiz</a>
</div>