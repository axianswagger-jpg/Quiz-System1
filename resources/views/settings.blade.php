@extends('layouts.app')

@section('content')
<div class="dashboard-wrap">
    <aside class="glass-panel sidebar">
        <div class="sidebar-group">
            <div class="sidebar-label">MENU</div>
            <a class="sidebar-link {{ request()->routeIs('quiz-history') ? 'active-link' : '' }}" href="{{ route('quiz-history') }}">Quiz History</a>

           <a class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active-link' : '' }}" href="{{ route('profile.edit') }}">Profile</a>
            <a class="sidebar-link {{ request()->routeIs('settings') ? 'active-link' : '' }}" href="{{ route('settings') }}">Settings</a>
           <a class="sidebar-link {{ request()->routeIs('scores') ? 'active-link' : '' }}" href="{{ route('scores') }}">My Scores</a>
           <a class="sidebar-link" href="{{ route('leaderboard') }}">Leaderboard</a>
            <a class="sidebar-link {{ request()->routeIs('quiz.index') ? 'active-link' : '' }}" href="{{ route('quiz.index') }}">Manage Quizzes</a>
            <a class="sidebar-link" href="{{ route('create-quiz') }}">Create Quiz</a>
        </div>

        <div class="sidebar-group">
            
        </div>
    </aside>

    <section class="dashboard-main glass-panel">
        <div class="settings-page">
            <div class="settings-container">

                <div class="form-wrap">
                    <form method="POST" action="{{ route('settings.profile.update') }}" enctype="multipart/form-data" class="profile-form">
                        @csrf
                        @method('PATCH')

                        <div class="photo-card">
                            <div class="photo-title">Profile photo</div>

                            <div class="photo-row">
                                <div class="avatar">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>

                                <div class="photo-info">
                                    <div class="photo-name">{{ auth()->user()->name }}</div>
                                    <div class="photo-sub">JPG, PNG or GIF. Max 2MB.</div>
                                </div>

                                <div class="photo-actions">
                                    <input type="file" name="profile_photo" class="file-input">
                                </div>
                            </div>
                        </div>

                        @php
                            $nameParts = explode(' ', auth()->user()->name, 2);
                            $firstName = $nameParts[0] ?? '';
                            $lastName = $nameParts[1] ?? '';
                        @endphp

                        <div class="info-card">
                            <div class="info-title">Personal information</div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">First name</label>
                                    <input type="text" name="first_name" value="{{ old('first_name', $firstName) }}" class="form-input">
                                    @error('first_name')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Last name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name', $lastName) }}" class="form-input">
                                    @error('last_name')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-input">
                                    @error('email')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username"
                                        value="{{ old('username', auth()->user()->username) }}"
                                        class="form-input" placeholder="@username">
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">Bio</label>
                                    <textarea name="bio"
                                        class="form-input"
                                        rows="3"
                                        placeholder="Tell something about yourself">{{ old('bio', auth()->user()->bio) }}</textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="reset" class="btn-cancel">Cancel</button>
                                <button type="submit" class="btn-save">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>

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
        </div>
    </section>
</div>

<style>
.settings-page {
    min-height: 100vh;
    padding: 0 !important;
}

.settings-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
}

.form-wrap {
    padding: 0 0 24px;
}

.profile-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.photo-card,
.info-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 18px;
    padding: 20px;
}

.photo-title,
.info-title {
    font-size: 20px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 16px;
}

.photo-row {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.avatar {
    width: 56px;
    height: 56px;
    border-radius: 999px;
    background: #2563eb;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 22px;
}

.photo-info {
    flex: 1;
    min-width: 180px;
}

.photo-name {
    font-size: 16px;
    font-weight: 700;
    color: #f8fafc;
}

.photo-sub {
    font-size: 13px;
    color: rgba(255,255,255,0.55);
    margin-top: 4px;
}

.file-input {
    color: white;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.full-width {
    grid-column: span 2;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #f8fafc;
}

.form-input {
    width: 100%;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.08);
    color: #ffffff;
    outline: none;
    transition: 0.2s ease;
}

.form-input:focus {
    border-color: rgba(96,165,250,0.8);
    box-shadow: 0 0 0 3px rgba(96,165,250,0.18);
}

.error-text {
    color: #f87171;
    font-size: 13px;
}

.form-actions {
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-cancel {
    padding: 10px 16px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.16);
    background: transparent;
    color: #f8fafc;
    cursor: pointer;
}

.btn-save {
    padding: 10px 18px;
    border-radius: 10px;
    border: none;
    background: #3b82f6;
    color: white;
    font-weight: 700;
    cursor: pointer;
}

.settings-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-top: 1px solid rgba(255,255,255,0.06);
    text-decoration: none;
    color: #f8fafc;
    transition: background 0.2s ease;
    cursor: pointer;
    background: rgba(255,255,255,0.04);
    border-radius: 18px;
    margin-bottom: 14px;
}

.settings-item:hover {
    background: rgba(255,255,255,0.05);
}

.item-title {
    font-weight: 700;
    font-size: 18px;
    color: #ffffff;
}

.item-sub {
    font-size: 13px;
    color: rgba(255,255,255,0.6);
    margin-top: 4px;
}

.arrow {
    font-size: 22px;
    color: rgba(255,255,255,0.45);
}

.logout-form {
    margin: 0;
}

.logout-btn {
    background: none;
    border: none;
    color: #f87171;
    font-weight: 700;
    cursor: pointer;
    font-size: 16px;
    padding: 0;
}

.switch {
    position: relative;
    width: 46px;
    height: 26px;
}

.switch input {
    display: none;
}

.slider {
    position: absolute;
    background: #334155;
    border-radius: 999px;
    width: 100%;
    height: 100%;
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

/* FORCE FIXED SIDEBAR */
.dashboard-wrap {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    position: fixed !important;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    padding: 110px 22px 22px 22px;
    overflow-y: auto;
    z-index: 1000;
}

.dashboard-main {
    margin-left: 280px !important;
    width: calc(100% - 280px);
    min-height: 100vh;
    padding: 28px;
}

body {
    overflow-x: hidden;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .full-width {
        grid-column: span 1;
    }

    .photo-row {
        flex-direction: column;
        align-items: flex-start;
    }

    .sidebar {
        position: relative !important;
        width: 100% !important;
        height: auto !important;
        padding: 90px 16px 16px 16px !important;
    }

    .dashboard-main {
        margin-left: 0 !important;
        width: 100% !important;
    }
}
</style>
@endsection