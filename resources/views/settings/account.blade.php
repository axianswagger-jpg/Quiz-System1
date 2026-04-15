@extends('layouts.app')

@section('content')
<div class="settings-page">
    <div class="settings-container">
        <h1 class="settings-title">Account Information</h1>

        <div class="settings-card">

            <div class="info-row">
                <label>Full Name</label>
                <p>{{ auth()->user()->name }}</p>
            </div>

            <div class="info-row">
                <label>Email</label>
                <p>{{ auth()->user()->email }}</p>
            </div>

            <div class="info-row">
                <label>Account Type</label>
                <p>Student</p>
            </div>

            <div class="info-row">
                <label>Joined</label>
                <p>{{ auth()->user()->created_at->format('M d, Y') }}</p>
            </div>

        </div>
    </div>
</div>

<style>
.settings-page {
    min-height: 100vh;
    background: #f4f6f9;
    padding: 30px 15px;
}

.settings-container {
    max-width: 500px;
    margin: auto;
}

.settings-title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 20px;
}

.settings-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.info-row {
    margin-bottom: 15px;
}

.info-row label {
    font-size: 12px;
    color: gray;
}

.info-row p {
    font-size: 16px;
    font-weight: 500;
}
</style>
@endsection