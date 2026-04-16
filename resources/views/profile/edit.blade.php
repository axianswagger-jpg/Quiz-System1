@extends('layouts.app')

@section('content')

<div class="dashboard-top">
    <div>
        <h1 class="dashboard-title">Profile</h1>
        <p class="dashboard-subtitle">Manage your account information, password, and account settings.</p>
    </div>
</div>

<div class="settings-panel">
    @include('profile.partials.update-profile-information-form')
</div>

<div class="settings-panel">
    @include('profile.partials.update-password-form')
</div>

<div class="settings-panel">
    @include('profile.partials.delete-user-form')
</div>

<style>
.settings-panel {
    margin-top: 24px;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.18);
    padding: 24px;
}
</style>

@endsection