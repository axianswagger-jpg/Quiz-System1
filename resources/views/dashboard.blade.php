<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(90deg, #14233f 0%, #020b1f 45%, #031225 100%);
            color: #e5e7eb;
        }

        .page {
            max-width: 1400px;
            margin: 18px auto;
            padding: 18px;
        }

        .shell {
            min-height: calc(100vh - 36px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 18px;
            background: linear-gradient(90deg, rgba(20,35,63,0.65) 0%, rgba(2,11,31,0.7) 45%, rgba(3,18,37,0.7) 100%);
            box-shadow: 0 10px 35px rgba(0,0,0,0.28);
            display: flex;
            overflow: hidden;
            backdrop-filter: blur(8px);
        }

        .sidebar {
            width: 250px;
            padding: 28px 18px;
            border-right: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.02);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
            padding: 8px 10px;
        }

        .logo {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, #42d392, #3b82f6);
            box-shadow: 0 8px 18px rgba(59,130,246,0.28);
        }

        .brand h2 {
            font-size: 28px;
            line-height: 1.1;
            font-weight: 700;
        }

        .brand p {
            font-size: 13px;
            color: #b7c0d4;
            margin-top: 4px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #8fa0bf;
            margin: 18px 10px 12px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 10px;
            color: #d7e1f0;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
            transition: 0.25s;
            cursor: pointer;
        }

        .sidebar li:hover,
        .sidebar li.active {
            background: linear-gradient(90deg, rgba(104,195,255,0.18), rgba(59,130,246,0.12));
            border-color: rgba(110,190,255,0.28);
            box-shadow: 0 8px 20px rgba(20,70,140,0.18);
        }

        .main {
            flex: 1;
            padding: 28px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .topbar h1 {
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .topbar p {
            color: #afbbcf;
            font-size: 18px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .badge {
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            color: #d9e4f5;
            font-size: 14px;
        }

        .logout-btn,
        .primary-btn {
            border: none;
            border-radius: 14px;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            background: linear-gradient(90deg, #68c3ff, #4f7fc5);
            box-shadow: 0 10px 24px rgba(90,157,238,0.25);
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .card,
        .panel {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 22px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.03), 0 14px 28px rgba(0,0,0,0.18);
            backdrop-filter: blur(10px);
        }

        .card {
            padding: 20px;
        }

        .card h3 {
            color: #b7c0d4;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 14px;
        }

        .card p {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #f3f7ff;
        }

        .card span {
            color: #91a0b9;
            font-size: 13px;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 18px;
            margin-bottom: 22px;
        }

        .panel {
            padding: 22px;
        }

        .panel h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .panel-sub {
            color: #aab6cb;
            font-size: 16px;
            margin-bottom: 18px;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 16px;
        }

        .feature-item {
            padding: 16px 18px;
            border-radius: 16px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            color: #dce6f7;
        }

        .quick-box {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 16px;
        }

        .quick-btn {
            padding: 15px 18px;
            border-radius: 16px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            color: #e5eefc;
            text-align: left;
            font-size: 15px;
            cursor: pointer;
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        th, td {
            text-align: left;
            padding: 14px 8px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: 14px;
        }

        th {
            color: #9fb0cb;
            font-weight: 600;
        }

        td {
            color: #eaf1fc;
        }

        .empty-text {
            text-align: center;
            color: #9fb0cb;
            padding: 24px 8px;
        }

        .activity-list {
            list-style: none;
            margin-top: 8px;
        }

        .activity-list li {
            padding: 14px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            color: #dce6f7;
            font-size: 14px;
        }

        @media (max-width: 1200px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero,
            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .shell {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid rgba(255,255,255,0.08);
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 10px;
                margin: 10px auto;
            }

            .main,
            .sidebar {
                padding: 18px;
            }

            .card-grid {
                grid-template-columns: 1fr;
            }

            .topbar h1 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="shell">
            <aside class="sidebar">
                <div class="brand">
                    <div class="logo"></div>
                    <div>
                        <h2>Quiz System</h2>
                        <p>Learn • Practice • Improve</p>
                    </div>
                </div>

                <div class="menu-title">Menu</div>
                <ul>
                    <li class="active">Dashboard</li>
                    <li>Take Quiz</li>
                    <li>My Scores</li>
                    <li>Quiz History</li>
                    <li>Leaderboard</li>
                    <li>Profile</li>
                    <li>Settings</li>
                </ul>

                <div class="menu-title">Admin</div>
                <ul>
                    <li>Create Quiz</li>
                    <li>Manage Questions</li>
                    <li>Manage Students</li>
                    <li>Reports</li>
                </ul>
            </aside>

            <main class="main">
                <div class="topbar">
                    <div>
                        <h1>Dashboard</h1>
                        <p>Welcome back. Here is your quiz overview.</p>
                    </div>
                    <div class="top-actions">
                        <div class="badge">Student / Admin</div>
                        <button class="logout-btn">Logout</button>
                    </div>
                </div>

                <section class="card-grid">
                    <div class="card">
                        <h3>Available Quizzes</h3>
                        <p>0</p>
                        <span>No quizzes yet</span>
                    </div>
                    <div class="card">
                        <h3>Completed Quizzes</h3>
                        <p>0</p>
                        <span>No attempts yet</span>
                    </div>
                    <div class="card">
                        <h3>Average Score</h3>
                        <p>0%</p>
                        <span>No scores yet</span>
                    </div>
                    <div class="card">
                        <h3>Leaderboard Rank</h3>
                        <p>-</p>
                        <span>No ranking yet</span>
                    </div>
                </section>

                <section class="hero">
                    <div class="panel">
                        <h2>Stay on track ✨</h2>
                        <p class="panel-sub">
                            Monitor your progress, check updates, and continue your quiz journey with a clean and modern dashboard.
                        </p>
                        <div class="feature-list">
                            <div class="feature-item">📚 View available quizzes anytime</div>
                            <div class="feature-item">📈 Track scores and performance easily</div>
                            <div class="feature-item">🏆 Check leaderboard and recent activity</div>
                        </div>
                    </div>

                    <div class="panel">
                        <h2>Quick Actions</h2>
                        <p class="panel-sub">Common pages you can open right away.</p>
                        <div class="quick-box">
                            <button class="quick-btn">Start New Quiz</button>
                            <button class="quick-btn">View My Scores</button>
                            <button class="quick-btn">Open Leaderboard</button>
                            <button class="primary-btn">Go to Reports</button>
                        </div>
                    </div>
                </section>

                <section class="bottom-grid">
                    <div class="panel">
                        <h2>Available Quizzes</h2>
                        <p class="panel-sub">Latest quiz list and status overview.</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Quiz</th>
                                    <th>Subject</th>
                                    <th>Attempts</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="empty-text">No quizzes available yet</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="panel">
                        <h2>Recent Activity</h2>
                        <p class="panel-sub">Your latest actions and updates.</p>
                        <ul class="activity-list">
                            <li>No recent activity</li>
                        </ul>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>
</html>