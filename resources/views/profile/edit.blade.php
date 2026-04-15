@extends('layouts.app')

@section('content')
<div class="dashboard-main">
    <div class="glass-panel" style="padding: 28px; max-width: 900px;">
        <h1 style="font-size: 42px; font-weight: 800; margin: 0 0 8px;">Profile</h1>
        <p style="color: var(--muted); margin: 0 0 24px;">
            Manage your account information, password, and account settings.
        </p>

        <div style="display: grid; gap: 20px;">
            <div style="padding: 24px; background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: 18px;">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div style="padding: 24px; background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: 18px;">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div style="padding: 24px; background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: 18px;">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
