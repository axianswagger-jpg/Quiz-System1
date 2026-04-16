@extends('layouts.app')

@section('content')
<div class="auth-wrap">
   
        <h1>Welcome back 👋</h1>
        <p>Log in to take quizzes, track your attempts, and view your results.</p>

        <div class="feature-list">
            <div class="feature-item">✅ Attempt limits supported</div>
            <div class="feature-item">⏱️ Timer-ready quiz UI</div>
            <div class="feature-item">📊 Result history</div>
        </div>
    </section>

        <h2>Login</h2>
        <p>Use your email and password to continue.</p>

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <label class="checkbox-row">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="inline-link">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-full">Sign in</button>

            <p class="bottom-link">
                Don’t have an account?
                <a href="{{ route('register') }}" class="inline-link">Create one</a>
            </p>
        </form>
    </section>
</div>
@endsection