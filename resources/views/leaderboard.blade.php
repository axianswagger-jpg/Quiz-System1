@extends('layouts.app')

@section('content')
<style>
    .current-user-row {
    background: rgba(104, 195, 255, 0.10);
}

.current-user-row td {
    font-weight: 700;
}
.leaderboard-page {
    padding: 40px 20px;
    color: #f8fafc;
}

.leaderboard-title {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 8px;
}

.leaderboard-subtitle {
    color: #9fb0cb;
    margin-bottom: 24px;
}

.leaderboard-card {
    background: rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 20px;
    border: 1px solid rgba(255,255,255,0.08);
}

.leaderboard-table {
    width: 100%;
    border-collapse: collapse;
}

.leaderboard-table th {
    text-align: left;
    padding: 14px;
    color: #9fb0cb;
    font-size: 13px;
}

.leaderboard-table td {
    padding: 14px;
    border-top: 1px solid rgba(255,255,255,0.08);
}

.rank {
    font-weight: 800;
    color: #68c3ff;
}
</style>

<div class="leaderboard-page">
    <h1 class="leaderboard-title">🏆 Leaderboard</h1>
    <p class="leaderboard-subtitle">Top users based on average score</p>

    <div class="leaderboard-card">
        <table class="leaderboard-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User</th>
                    <th>Avg Score</th>
                    <th>Attempts</th>
                </tr>
            </thead>
            <tbody>
    @forelse($leaderboard as $index => $entry)
        <tr class="{{ auth()->id() == $entry->user_id ? 'current-user-row' : '' }}">
            <td class="rank">
                @if($index === 0)
                    🥇 #1
                @elseif($index === 1)
                    🥈 #2
                @elseif($index === 2)
                    🥉 #3
                @else
                    #{{ $index + 1 }}
                @endif
            </td>
            <td>
    {{ $entry->user->name ?? 'Unknown User' }}
    @if(auth()->id() == $entry->user_id)
        <span style="color:#68c3ff; font-weight:700;">(You)</span>
    @endif
</td>
            <td>{{ round($entry->avg_score) }}%</td>
            <td>{{ $entry->total_attempts }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No data yet.</td>
        </tr>
    @endforelse
</tbody>
        </table>
    </div>
</div>
@endsection