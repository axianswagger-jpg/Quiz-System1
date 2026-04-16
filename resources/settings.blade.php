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
<style>
    /* Ensure the container is centered */
    .dashboard-main {
        display: flex;
        justify-content: center;  /* Centers horizontally */
        align-items: center;      /* Centers vertically */
        padding: 20px;            /* Add padding to give space around content */
        min-height: 100vh;        /* Make sure it takes the full height */
    }

    .settings-container {
        width: 100%; /* Full width */
        max-width: 1200px;  /* Set a max width for larger screens */
        margin: 0 auto;  /* Center the container */
        padding: 20px;  /* Padding for spacing */
    }

    .settings-title {
        text-align: center; /* Center the title */
        font-size: 32px;
        margin-bottom: 20px;
    }

    /* Add more specific styling for different sections */
    .settings-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .item-title {
        font-size: 18px;
        font-weight: bold;
    }

    .item-sub {
        font-size: 14px;
        color: #888;
    }

    /* Styling for form input */
    .form-input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    /* Button styling */
    .btn-save {
        background-color: #3498db;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-save:hover {
        background-color: #2980b9;
    }
</style>
</style>
@endsection