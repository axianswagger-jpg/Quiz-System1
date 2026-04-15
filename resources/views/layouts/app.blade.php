<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Quiz System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <style>
        /* ── Global Responsive Fix ── */
        * { box-sizing: border-box; }

        .page-shell {
            min-height: 100vh;
            overflow-x: hidden;
        }
        .brand-logo {
    font-family: 'Poppins', sans-serif;
    font-weight: 800;
    font-size: 32px;
    color: #ffffff;
    letter-spacing: -0.5px;
    text-decoration: none;
}

        /* Sidebar + Main layout */
        .shell {
            display: flex;
            flex-wrap: wrap;
        }

       /* ===== LAYOUT WRAPPER ===== */
.dashboard-wrap {
    display: flex;
    min-height: 100vh;
}

/* ===== SIDEBAR (FIXED) ===== */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;

    padding: 110px 22px 22px 22px; /* space for logo */

    overflow-y: auto;
    z-index: 1000;
}

/* ===== MAIN CONTENT ===== */
.dashboard-main {
    margin-left: 260px; /* same as sidebar width */
    width: calc(100% - 260px);

    padding: 30px;
    min-height: 100vh;
}
/* ===== ACTIVE SIDEBAR LINK ===== */
.sidebar-link {
    transition: all 0.2s ease;
}

.active-link {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    box-shadow: inset 0 0 10px rgba(255,255,255,0.05);
}

        /* Card grids */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        /* ── Tablet (max 1024px) ── */
        @media (max-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .hero, .bottom-grid {
                grid-template-columns: 1fr !important;
            }
        }

        /* ── Mobile (max 768px) ── */
        @media (max-width: 768px) {
            .shell {
                flex-direction: column !important;
            }
            .sidebar {
                width: 100% !important;
                border-right: none !important;
                border-bottom: 1px solid rgba(255,255,255,0.08);
            }
            .main {
                padding: 16px !important;
            }
            .card-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 10px !important;
            }
            .topbar {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 12px !important;
            }
            .topbar h1 {
                font-size: 28px !important;
            }
            .hero, .bottom-grid {
                grid-template-columns: 1fr !important;
            }
        }

        /* ── Small Mobile (max 480px) ── */
        @media (max-width: 480px) {
            .card-grid {
                grid-template-columns: 1fr !important;
            }
            .sidebar {
                padding: 1px !important;
            }
            .topbar h1 {
                font-size: 24px !important;
            }
        }
    </style>
</head>
<body>

       <!-- LOGO (TOP LEFT) -->
    <div style="position: fixed; top: 28px; left: 25px; z-index: 2000;">
    <a href="{{ route('dashboard') }}" class="brand-logo">
        QuizMo

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