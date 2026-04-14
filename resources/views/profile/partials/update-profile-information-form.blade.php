<section>
    <header style="margin-bottom: 20px;">
        <h2 style="font-size: 24px; font-weight: 800; color: white; margin: 0 0 8px;">
            Profile Information
        </h2>

        <p style="margin: 0; font-size: 14px; color: var(--muted);">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" style="display: grid; gap: 18px;">
        @csrf
        @method('patch')

        <div>
            <label for="name" style="display: block; margin-bottom: 8px; color: var(--muted); font-size: 14px;">
                Name
            </label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                style="width: 100%; padding: 14px 16px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: #f7f8fb; color: #18243f; outline: none;"
            >
            @error('name')
                <p style="margin-top: 8px; color: #ffb4b4; font-size: 13px;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" style="display: block; margin-bottom: 8px; color: var(--muted); font-size: 14px;">
                Email
            </label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                style="width: 100%; padding: 14px 16px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: #f7f8fb; color: #18243f; outline: none;"
            >
            @error('email')
                <p style="margin-top: 8px; color: #ffb4b4; font-size: 13px;">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: 12px;">
                    <p style="font-size: 14px; color: var(--muted);">
                        Your email address is unverified.

                        <button
                            form="send-verification"
                            style="background: none; border: none; padding: 0; color: #8ec8ff; text-decoration: underline; cursor: pointer; font-size: 14px;"
                        >
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: 8px; font-size: 13px; color: #86efac;">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 14px;">
            <button
                type="submit"
                style="display: inline-flex; align-items: center; justify-content: center; min-width: 138px; padding: 14px 22px; border-radius: 14px; border: 1px solid var(--border); font-weight: 700; cursor: pointer; background: linear-gradient(180deg, #73c3ff, #5aa5ea); color: white;"
            >
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="font-size: 14px; color: var(--muted); margin: 0;"
                >
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
