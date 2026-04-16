<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Quiz System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <style>
        /* Global Styles */
        * { box-sizing: border-box; }

        .page-shell {
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar + Main layout */
        .dashboard-wrap {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            padding: 110px 22px 22px 22px; /* space for logo */
            overflow-y: auto;
            z-index: 1000;
            background: #1e293b; /* Dark sidebar color */
        }

        .dashboard-main {
    margin-left: 260px;
    padding: 30px 60px;  /* more horizontal padding */
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    width: calc(100% - 260px);  /* ADD THIS */
    max-width: 100%;             /* ADD THIS */
}

        /* Brand Logo (Always visible) */
        .brand-logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 32px;
            color: #ffffff;
            letter-spacing: -0.5px;
            text-decoration: none;
            position: fixed;
            top: 28px;
            left: 25px;
            z-index: 2000;
        }

        /* Sidebar Link Styling */
        .sidebar-link {
            display: block;
            padding: 12px 18px;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>

<!-- QuizMo Logo (Fixed to the top-left) -->
<div class="brand-logo">
    <a href="{{ route('dashboard') }}">QuizMo</a>
</div>

<main class="page-shell">
 @auth
    @unless(Request::is('login') || Request::is('register') || Request::is('welcome'))
        <div class="dashboard-wrap">
            <aside class="sidebar">
                <div class="sidebar-group">
                    <p class="sidebar-label">MENU</p>
                    <a href="{{ route('quiz-history') }}" class="sidebar-link">Quiz History</a>
                    <a href="{{ route('profile.edit') }}" class="sidebar-link">Profile</a>
                    <a href="{{ route('settings') }}" class="sidebar-link">Settings</a>
                    <a href="{{ route('scores') }}" class="sidebar-link">My Scores</a>
                   
                    <a href="{{ route('quiz.index') }}" class="sidebar-link">Manage Quizzes</a>
                </div>
                <div class="sidebar-group">
                    <a href="{{ route('create-quiz') }}" class="sidebar-link">Create Quiz</a>
                </div>
            </aside>
            <div class="dashboard-main">
                @yield('content')
            </div>
        </div>
    @endunless
@endauth

@guest
    @yield('content')
@endguest

</body>
</html>
