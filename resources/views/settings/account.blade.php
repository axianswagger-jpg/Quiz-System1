@extends('layouts.app')

@section('content')
<div class="settings-page">
    <div class="settings-container">
        <div class="top-bar">
            <a href="{{ route('settings.edit') }}" class="back-btn">←</a>
            <h1 class="settings-title">Account Information</h1>
            <div class="top-space"></div>
        </div>

        <div class="settings-card">
            <div class="info-item">
                <span class="info-label">Full Name</span>
                <span class="info-value">{{ auth()->user()->name }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Email</span>
                <span class="info-value">{{ auth()->user()->email }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Account Type</span>
                <span class="info-value">Student</span>
            </div>

            <div class="info-item">
                <span class="info-label">Joined</span>
                <span class="info-value">{{ auth()->user()->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>
</div>

<style>
.settings-page {
    min-height: 100vh;
    background: #f3f4f6;
    padding: 30px 15px;
}

.settings-container {
    max-width: 500px;
    margin: auto;
}

.top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.back-btn {
    text-decoration: none;
    font-size: 28px;
    color: #111827;
    font-weight: bold;
    width: 40px;
}

.top-space {
    width: 40px;
}

.settings-title {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.settings-card {
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.info-item {
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-size: 13px;
    color: #6b7280;
}

.info-value {
    font-size: 17px;
    font-weight: 600;
    color: #111827;
}
</style>
@endsection