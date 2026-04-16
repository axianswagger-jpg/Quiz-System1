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
