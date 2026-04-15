@extends('layouts.app')

@section('content')
<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
            <div class="sidebar-label">MENU</div>
            <a class="sidebar-link" href="{{ route('quiz-history') }}">Quiz History</a>
            <a class="sidebar-link" href="{{ route('profile.edit') }}">Profile</a>
            <a class="sidebar-link active-link" href="{{ route('settings') }}">Settings</a>
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
                <h1 class="dashboard-title">Settings</h1>
                <p class="dashboard-subtitle">Manage your account settings and security.</p>
            </div>

            <div class="dashboard-top-right">
                <span class="user-pill">Account Settings</span>
            </div>
        </div>

        <div class="settings-panel">
            <div class="settings-section-title">Account Settings</div>

            <a href="{{ route('settings.account') }}" class="settings-item">
                <div>
                    <div class="item-title">Account Information</div>
                    <div class="item-sub">View and edit your profile</div>
                </div>
                <div class="arrow">›</div>
            </a>

            <a href="{{ route('settings.security') }}" class="settings-item">
                <div>
                    <div class="item-title">Sign in and Security</div>
                    <div class="item-sub">Change your password</div>
                </div>
                <div class="arrow">›</div>
            </a>

            <div class="settings-item">
                <div>
                    <div class="item-title">Email Notifications</div>
                    <div class="item-sub">Receive quiz updates</div>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="settings-item logout-form">
                @csrf
                <button type="submit" class="logout-btn">Sign Out</button>
            </form>
        </div>
    </section>
</div>

<style>
    .settings-panel {
        margin-top: 24px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.18);
    }

    .settings-section-title {
        padding: 18px 22px;
        font-size: 14px;
        color: rgba(255,255,255,0.55);
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .settings-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 22px;
        text-decoration: none;
        color: #fff;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        transition: background 0.2s ease;
    }

    .settings-item:hover {
        background: rgba(255,255,255,0.04);
    }

    .settings-item:last-child {
        border-bottom: none;
    }

    .item-title {
        font-size: 16px;
        font-weight: 700;
        color: #f8fafc;
    }

    .item-sub {
        font-size: 13px;
        color: rgba(255,255,255,0.6);
        margin-top: 4px;
    }

    .arrow {
        font-size: 24px;
        color: rgba(255,255,255,0.45);
        line-height: 1;
    }

    .logout-form {
        margin: 0;
    }

    .logout-btn {
        background: none;
        border: none;
        color: #f87171;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        padding: 0;
    }

    .active-link {
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.10);
    }

    .switch {
        position: relative;
        width: 46px;
        height: 26px;
        flex-shrink: 0;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        inset: 0;
        background: #334155;
        border-radius: 999px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .slider::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        left: 3px;
        top: 3px;
        background: white;
        border-radius: 50%;
        transition: 0.3s ease;
    }

    .switch input:checked + .slider {
        background: #22c55e;
    }

    .switch input:checked + .slider::before {
        transform: translateX(20px);
    }

    @media (max-width: 768px) {
        .settings-item {
            padding: 16px 18px;
        }

        .item-title {
            font-size: 15px;
        }

        .item-sub {
            font-size: 12px;
        }
    }
</style>
@endsection