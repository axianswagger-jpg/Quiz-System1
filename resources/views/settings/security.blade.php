@extends('layouts.app')

@section('content')
<div class="security-page">
    <div class="security-container">
        <h1 class="security-title">Security</h1>
        <p class="security-subtitle">Change your password to keep your account secure.</p>

        @if (session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        <div class="security-card">
            <form method="POST" action="{{ route('settings.password.update') }}" class="security-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-input" placeholder="Enter current password">
                    @error('current_password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter new password">
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm new password">
                </div>

                <button type="submit" class="save-btn">Update Password</button>
            </form>
        </div>
    </div>
</div>

<style>
.security-page {
    min-height: 100vh;
    padding: 40px 15px;
    background: radial-gradient(circle at top left, #112a64, #03163d 60%, #02102b 100%);
}

.security-container {
    max-width: 900px;
    margin: auto;
}

.security-title {
    font-size: 56px;
    font-weight: 800;
    color: #f8fafc;
    margin-bottom: 8px;
    line-height: 1;
}

.security-subtitle {
    font-size: 16px;
    color: rgba(255,255,255,0.65);
    margin-bottom: 28px;
}

.security-card {
    background: rgba(255,255,255,0.04);
    border-radius: 22px;
    padding: 28px;
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 20px 40px rgba(0,0,0,0.30);
}

.security-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
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

.form-input::placeholder {
    color: rgba(255,255,255,0.45);
}

.form-input:focus {
    border-color: rgba(96,165,250,0.8);
    box-shadow: 0 0 0 3px rgba(96,165,250,0.18);
}

.save-btn {
    width: fit-content;
    padding: 12px 20px;
    border: none;
    border-radius: 12px;
    background: #60a5fa;
    color: white;
    font-weight: 700;
    cursor: pointer;
}

.save-btn:hover {
    background: #3b82f6;
}

.error-text {
    color: #f87171;
    font-size: 13px;
}

.success-box {
    margin-bottom: 16px;
    padding: 12px 16px;
    border-radius: 12px;
    background: rgba(74,222,128,0.10);
    border: 1px solid rgba(74,222,128,0.30);
    color: #4ade80;
}
</style>
@endsection