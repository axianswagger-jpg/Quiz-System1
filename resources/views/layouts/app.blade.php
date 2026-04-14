<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Quiz System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
</head>
<body>

       <!-- LOGO (TOP LEFT) -->
    <div style="position: fixed; top: 28px; left: 25px; z-index: 2000;">
    <a href="{{ route('dashboard') }}" class="brand-logo">
        QuizMo
    </a>

    </a>
</div>

    <main class="page-shell">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.addEventListener('mousemove', (e) => {
                    const rect = link.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    // Calculate angle from center to cursor
                    const angle = Math.atan2(y - centerY, x - centerX) * (180 / Math.PI);

                    link.style.boxShadow = `
                        inset 0 0 0 1px rgba(255,255,255,0.5),
                        ${Math.cos((angle * Math.PI) / 180) * 6}px ${Math.sin((angle * Math.PI) / 180) * 6}px 14px rgba(255,255,255,0.2),
                        0 8px 20px rgba(0,0,0,0.3)
                    `;
                });

                link.addEventListener('mouseleave', () => {
                    link.style.boxShadow = '';
                    link.style.transform = '';
                });
            });
        });
    </script>
</body>
</html>
