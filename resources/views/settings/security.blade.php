@extends('layouts.app')

@section('content')
<div class="settings-page">
    <div class="settings-container">
        <div class="top-bar">
            <a href="{{ route('settings') }}" class="back-btn">←</a>
            <h1 class="settings-title">Sign in and Security</h1>
            <div class="top-space"></div>
        </div>

        @if(session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        <div class="settings-card">
            <div class="card-header">
                <h2>Change Password</h2>
                <p>Update your password to keep your account secure.</p>
            </div>

            <form method="POST" action="{{ route('settings.password.update') }}" class="security-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-input" placeholder="Enter current password">
                    @error('current_password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter new password">
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm new password">
                </div>

                <button type="submit" class="save-btn">Update Password</button>
            </form>
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
    text-align: center;
}

.success-box {
    margin-bottom: 15px;
    padding: 12px 16px;
    border-radius: 12px;
    background: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
}

.settings-card {
    background: #fff;
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.card-header h2 {
    margin: 0 0 6px 0;
    font-size: 24px;
    color: #111827;
}

.card-header p {
    margin: 0 0 20px 0;
    color: #6b7280;
    font-size: 14px;
}

.security-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}

.form-input {
    width: 100%;
    padding: 13px 14px;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    color: #111827;
    background: #fff;
    outline: none;
}

.form-input:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.2);
}

.form-input::placeholder {
    color: #9ca3af;
}

.save-btn {
    margin-top: 4px;
    border: none;
    border-radius: 12px;
    background: #2563eb;
    color: white;
    padding: 13px 16px;
    font-weight: 600;
    cursor: pointer;
}

.save-btn:hover {
    background: #1d4ed8;
}

.error-text {
    color: #dc2626;
    font-size: 13px;
}
</style>
@endsection