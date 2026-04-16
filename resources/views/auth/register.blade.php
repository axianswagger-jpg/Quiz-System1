@extends('layouts.app')

@section('content')
<div class="auth-wrap">
   
        <h1>Create your account ✨</h1>
        <p>Register to start taking quizzes and track your progress.</p>

        <div class="feature-list">
            <div class="feature-item">🚀 Quick setup</div>
            <div class="feature-item">🧠 Learn at your pace</div>
            <div class="feature-item">🎯 Improve with attempts</div>
        </div>
    </section>

   
        <h2>Register</h2>
        <p>Fill in your details to get started.</p>

        <form method="POST" action="{{ route('register') }}" class="auth-form" id="registerForm">
            @csrf

            <div>
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Your name">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required placeholder="Create a password">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repeat your password">

                <!-- ❌ Error -->
                <div id="password-match-error" class="form-error" style="display: none;">
                    The password confirmation does not match.
                </div>

                <!-- ✅ Success -->
                <div id="password-match-success" class="form-success" style="display: none; color: #4ade80;">
                    Passwords match ✓
                </div>

                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-full">Create account</button>

            <p class="bottom-link">
                Already have an account?
                <a href="{{ route('login') }}" class="inline-link">Login</a>
            </p>
        </form>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    const errorText = document.getElementById('password-match-error');
    const successText = document.getElementById('password-match-success');

    function checkPasswordMatch() {
        const passwordValue = password.value;
        const confirmValue = confirmPassword.value;

        if (confirmValue.length === 0) {
            errorText.style.display = 'none';
            successText.style.display = 'none';
            confirmPassword.style.borderColor = '';
            return true;
        }

        if (passwordValue !== confirmValue) {
            errorText.style.display = 'block';
            successText.style.display = 'none';
            confirmPassword.style.borderColor = '#fca5a5';
            return false;
        }

        errorText.style.display = 'none';
        successText.style.display = 'block';
        confirmPassword.style.borderColor = '#4ade80';
        return true;
    }

    password.addEventListener('input', checkPasswordMatch);
    confirmPassword.addEventListener('input', checkPasswordMatch);

    form.addEventListener('submit', function (e) {
        if (!checkPasswordMatch()) {
            e.preventDefault();
        }
    });
});
</script>
@endsection