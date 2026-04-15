@extends('layouts.app')

@section('content')
<div class="settings-page">
    <div class="settings-container">
        <h1 class="settings-title">Settings</h1>

        <div class="settings-card">
            <div class="settings-section-title">Account Settings</div>

           <div class="settings-item" onclick="window.location='{{ route('profile.edit') }}'">
    <div>
        <div class="item-title">Account Information</div>
        <div class="item-sub">View and edit your profile</div>
    </div>
    <span class="arrow">›</span>
</div>

<div class="settings-item" onclick="window.location='{{ route('profile.edit') }}'">
    <div>
        <div class="item-title">Sign in and Security</div>
        <div class="item-sub">Change your password</div>
    </div>
    <span class="arrow">›</span>
</div>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="settings-item logout-btn-wrap">
                    <span class="item-title logout-btn">Sign Out</span>
                    <span class="arrow">›</span>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.settings-page {
    min-height: 100vh;
    padding: 40px 15px;
    background: radial-gradient(circle at top left, #112a64, #03163d 60%, #02102b 100%);
}

.settings-container {
    max-width: 900px;
    margin: auto;
}

.settings-title {
    font-size: 56px;
    font-weight: 800;
    color: #f8fafc;
    margin-bottom: 28px;
    line-height: 1;
}

.settings-card {
    background: rgba(255,255,255,0.04);
    border-radius: 22px;
    padding: 8px 0;
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 20px 40px rgba(0,0,0,0.30);
    overflow: hidden;
}

.settings-section-title {
    padding: 18px 24px;
    font-size: 14px;
    color: rgba(255,255,255,0.55);
}

.settings-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 20px 24px;
    border-top: 1px solid rgba(255,255,255,0.06);
    text-decoration: none;
    color: #f8fafc;
    background: transparent;
    transition: background 0.2s ease;
    cursor: pointer;
    box-sizing: border-box;
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
    flex-shrink: 0;
}

.logout-form {
    margin: 0;
}

.logout-btn-wrap {
    border: none;
    text-align: left;
}

.logout-btn {
    color: #f87171;
}
</style>
@endsection