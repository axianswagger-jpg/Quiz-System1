@extends('layouts.app')

@section('content')
<div style="display:grid; grid-template-columns: 1.1fr .9fr; gap:18px; align-items:start;"
     class="register-grid">

    {{-- Left: intro card --}}
    <div class="card">
        <h1 style="margin:0 0 10px; font-size:28px;">Create your account ✨</h1>
        <p class="muted" style="margin:0 0 14px; line-height:1.6;">
            Register to start taking quizzes and track your progress.
        </p>

        <div style="display:grid; gap:10px; margin-top:14px;">
            <div style="padding:12px; border:1px solid var(--border); border-radius:14px; background:rgba(255,255,255,.03);">
                🚀 Quick setup
            </div>
            <div style="padding:12px; border:1px solid var(--border); border-radius:14px; background:rgba(255,255,255,.03);">
                🧠 Learn at your pace
            </div>
            <div style="padding:12px; border:1px solid var(--border); border-radius:14px; background:rgba(255,255,255,.03);">
                🎯 Improve with attempts
            </div>
        </div>
    </div>

    {{-- Right: form card --}}
    <div class="card">
        <h2 style="margin:0 0 6px;">Register</h2>
        <p class="muted" style="margin:0 0 12px;">Fill in your details to get started.</p>

       <form method="POST" action="{{ route('register') }}">
    @csrf

            <div class="field">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Your name" required>
            </div>

            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="field">
                <label>Password</label>
                <input id="regPass" type="password" name="password" placeholder="Create a password" required>
            </div>

            <div class="field">
                <label>Confirm Password</label>
                <input id="regPass2" type="password" name="password_confirmation" placeholder="Repeat your password" required>
                <div id="pwMsg" class="muted" style="font-size:13px; margin-top:8px;"></div>
            </div>

            <button class="btn" type="submit" style="margin-top:14px;">Create account</button>
        </form>

        <p class="muted" style="margin-top:14px; font-size:14px;">
            Already have an account?
            <a href="{{ route('login.page') }}">Login</a>
        </p>
    </div>
</div>

<style>
    @media (max-width: 900px){
        .register-grid{ grid-template-columns: 1fr !important; }
    }
</style>

<script>
    const p1 = document.getElementById('regPass');
    const p2 = document.getElementById('regPass2');
    const msg = document.getElementById('pwMsg');

    function checkMatch(){
        if(!p1.value || !p2.value){
            msg.textContent = '';
            return;
        }
        if(p1.value === p2.value){
            msg.textContent = '✅ Passwords match';
            msg.style.color = '#9ef0b7';
        } else {
            msg.textContent = '❌ Passwords do not match';
            msg.style.color = '#ffb3b3';
        }
    }

    p1.addEventListener('input', checkMatch);
    p2.addEventListener('input', checkMatch);
</script>
@endsection