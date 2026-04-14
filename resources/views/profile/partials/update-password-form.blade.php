<section>
    <header style="margin-bottom: 20px;">
        <h2 style="font-size: 24px; font-weight: 800; color: white; margin: 0 0 8px;">
            Update Password
        </h2>

        <p style="margin: 0; font-size: 14px; color: var(--muted);">
            Ensure your account is using a strong password.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" style="display: grid; gap: 18px;">
        @csrf
        @method('put')

        <!-- CURRENT PASSWORD -->
        <div>
            <label style="display: block; margin-bottom: 8px; color: var(--muted);">Current Password</label>
            <input type="password" name="current_password"
                style="width: 100%; padding: 14px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: #f7f8fb; color: #18243f;">
            @error('current_password', 'updatePassword')
                <p style="color: #ffb4b4; font-size: 13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- NEW PASSWORD -->
        <div>
            <label style="display: block; margin-bottom: 8px; color: var(--muted);">New Password</label>
            <input type="password" name="password"
                style="width: 100%; padding: 14px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: #f7f8fb; color: #18243f;">
            @error('password', 'updatePassword')
                <p style="color: #ffb4b4; font-size: 13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- CONFIRM PASSWORD -->
        <div>
            <label style="display: block; margin-bottom: 8px; color: var(--muted);">Confirm Password</label>
            <input type="password" name="password_confirmation"
                style="width: 100%; padding: 14px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: #f7f8fb; color: #18243f;">
            @error('password_confirmation', 'updatePassword')
                <p style="color: #ffb4b4; font-size: 13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- BUTTON -->
        <div style="display: flex; align-items: center; gap: 12px;">
            <button type="submit"
                style="padding: 14px 22px; border-radius: 14px; font-weight: 700; background: linear-gradient(180deg, #73c3ff, #5aa5ea); color: white; border: none; cursor: pointer;">
                Save
            </button>

            @if (session('status') === 'password-updated')
                <p style="font-size: 14px; color: var(--muted);">Saved.</p>
            @endif
        </div>
    </form>
</section>
