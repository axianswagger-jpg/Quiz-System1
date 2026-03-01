<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz System</title>

    <style>
        :root{
            --bg:#0b1220;
            --card:rgba(255,255,255,.06);
            --border:rgba(255,255,255,.12);
            --text:#eef2ff;
            --muted:rgba(238,242,255,.70);
            --accent:#6ea8fe;
        }

        *{ box-sizing:border-box; }
        body{
            margin:0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
            color:var(--text);
            min-height:100vh;
            background:
                radial-gradient(900px 600px at 15% 10%, rgba(110,168,254,.22), transparent 45%),
                radial-gradient(900px 600px at 85% 30%, rgba(43, 130, 165, 0.16), transparent 45%),
                var(--bg);
        }

        .container{
            width:min(1100px, 92vw);
            margin:0 auto;
            padding:32px 0;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding: 18px 0;
        }

        .brand{
            display:flex;
            align-items:center;
            gap:12px;
            font-weight:800;
            letter-spacing:.3px;
        }
        .logo{
            width:42px;height:42px;
            border-radius:14px;
            background: linear-gradient(135deg, rgba(45, 168, 162, 0.95), rgba(81,207,102,.75));
            box-shadow: 0 18px 50px rgba(0,0,0,.35);
        }
        .badge{
            font-size:12px;
            padding:5px 10px;
            border:1px solid var(--border);
            border-radius:999px;
            color:var(--muted);
        }

        .card{
            background: var(--card);
            border:1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 18px 60px rgba(0,0,0,.35);
            backdrop-filter: blur(10px);
        }

        a{ color:var(--accent); text-decoration:none; }
        a:hover{ text-decoration:underline; }

        /* small helpers */
        .muted{ color:var(--muted); }
        .btn{
            width:100%;
            padding: 12px 14px;
            border-radius: 14px;
            border:1px solid rgba(110,168,254,.35);
            background: linear-gradient(135deg, rgba(110, 201, 254, 0.95), rgba(110,168,254,.55));
            color: var(--text);
            font-weight:700;
            cursor:pointer;
        }
        .btn:hover{ filter: brightness(1.05); }

        .field{
            margin-top: 12px;
        }
        label{
            display:block;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 6px;
        }
        input{
    width:100%;
    padding:12px;
    border-radius:14px;
    border:1px solid var(--border);
    background:#ffffff;   /* changed */
    color:#000000;        /* changed */
    outline:none;
}
        input:focus{
            border-color: rgba(206, 35, 120, 0.8);
            box-shadow: 0 0 0 4px rgba(110,168,254,.12);
        }
    <style>

input:focus{
    border-color: rgba(206, 35, 120, 0.8);
    box-shadow: 0 0 4px rgba(110,168,254,.12);
}

/* 👇 ADD IT HERE */
.card {
    position: relative;
}

.card::before {
    content: "";
    position: absolute;
    inset: -1px;
    border-radius: 18px;
    background: linear-gradient(
        135deg,
        rgba(110,168,254,.4),
        rgba(81,207,102,.2)
    );
    opacity: 0;
    transition: 0.3s ease;
    z-index: -1;
}

.card:hover::before {
    opacity: 1;
}

</style>

</head>

<body>
    <div class="container">
        <div class="topbar">
            <div class="brand">
                <div class="logo"></div>
                <div>
                    Quiz System
                    <div class="muted" style="font-weight:500; font-size:12px;">Learn • Practice • Improve</div>
                </div>
            </div>
            <div class="badge">v1</div>
        </div>

        @yield('content')
    </div>
</body>
</html>