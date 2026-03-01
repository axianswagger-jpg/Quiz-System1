@extends('layouts.app')

@section('content')
<div class="card" style="text-align:center; padding:60px 20px;">
    <h1 style="font-size:36px; margin-bottom:10px;">
        Welcome to Quiz System 🎓
    </h1>

    <p class="muted" style="margin-bottom:30px;">
        Test your knowledge, track your attempts, and improve your skills.
    </p>

    <div style="display:flex; justify-content:center; gap:15px; flex-wrap:wrap;">
        <a href="{{ route('login.page') }}">
            <button class="btn">Login</button>
        </a>

        <a href="{{ route('register.page') }}">
            <button class="btn" style="background:rgba(255,255,255,.1); border:1px solid var(--border);">
                Register
            </button>
        </a>
    </div>
</div>
@endsection