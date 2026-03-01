@extends('layouts.app')

@section('content')
<div style="display:grid; grid-template-columns: 1.1fr .9fr; gap:18px; align-items:start;"
     class="login-grid">

    {{-- Left: intro card --}}
    <div class="card">
        <h1 style="margin:0 0 10px; font-size:28px;">Welcome back 👋</h1>
        <p class="muted" style="margin:0 0 14px; line-height:1.6;">
            Log in to take quizzes, track your attempts, and view your results.
        </p>

        <div style="display:grid; gap:10px; margin-top:14px;">
            <div style="padding:12px; border:1px solid var(--border); border-radius:14px; background:rgba(255,255,255,.03);">
                ✅ Attempt limits supported
            </div>
            <div style="padding:12px; border:1px solid var(--border); border-radius:14px; background:rgba(255,255,255,.03);">
                ⏱️ Timer-ready quiz UI
            </div>
            <div style="padding:12px; border:1px solid var(--border); border-radius:14px; background:rgba(255,255,255,.03);">
                📊 Result history
            </div>
        </div>
    </div>

    {{-- Right: form card --}}
    <div class="card">
        <h2 style="margin:0 0 6px;">Login</h2>
        <p class="muted" style="margin:0 0 12px;">Use your email and password to continue.</p>

        <form method="POST" action="#">
            @csrf

            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="field">
                <label>Password</label>

                <div style="position:relative;">
                    <input id="password" type="password" name="password" placeholder="••••••••" required style="padding-right:48px;">
                    <button type="button" id="togglePass"
                            style="position:absolute; right:8px; top:50%; transform:translateY(-50%);
                                   width:36px; height:36px; border-radius:12px;
                                   border:1px solid var(--border); background:rgba(255,255,255,.06);
                                   color:var(--text); cursor:pointer;">
                        👁
                    </button>
                </div>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:10px;">
                <label style="display:flex; align-items:center; gap:8px; margin:0; font-size:13px;">
                    <input type="checkbox" style="width:auto; margin:0;">
                    <span class="muted">Remember me</span>
                </label>

                <a href="#" class="muted" style="font-size:13px;">Forgot password?</a>
            </div>

            <button class="btn" type="submit" style="margin-top:14px;">Sign in</button>
        </form>

        <p class="muted" style="margin-top:14px; font-size:14px;">
            Don’t have an account?
            <a href="{{ route('register.page') }}">Create one</a>
        </p>
    </div>
</div>

<style>
    @media (max-width: 900px){
        .login-grid{ grid-template-columns: 1fr !important; }
    }
</style>

<script>
    const pass = document.getElementById('password');
    const toggle = document.getElementById('togglePass');

    toggle.addEventListener('click', () => {
        const isHidden = pass.type === 'password';
        pass.type = isHidden ? 'text' : 'password';
        toggle.textContent = isHidden ? '🙈' : '👁';
    });
</script>
@endsection