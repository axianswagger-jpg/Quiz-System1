<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attempt;
use App\Models\Quiz;

class AttemptController extends Controller
{
    // ── Submit quiz answers ──────────────────────────────
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|integer',
            'quiz_id'      => 'required|integer',
            'answers'      => 'required|array',
            'time_seconds' => 'nullable|integer|min:0',
        ]);

        $quiz = Quiz::findOrFail($validated['quiz_id']);

        $attemptsUsed = Attempt::where('user_id', $validated['user_id'])
            ->where('quiz_id', $validated['quiz_id'])
            ->count();

        if ($quiz->max_attempts > 0 && $attemptsUsed >= $quiz->max_attempts) {
            return response()->json([
                'success'       => false,
                'error'         => 'Attempt limit reached.',
                'attempts_used' => $attemptsUsed,
                'max_attempts'  => $quiz->max_attempts,
            ], 403);
        }

        // Save attempt (adjust fields to match your DB columns)
        $attempt = Attempt::create([
            'user_id'      => $validated['user_id'],
            'quiz_id'      => $validated['quiz_id'],
            'answers'      => $validated['answers'],               // cast to array/json in model
            'time_seconds' => $validated['time_seconds'] ?? 0,
            // 'score' => $score, // if you compute it
        ]);

        return response()->json([
            'success'       => true,
            'message'       => 'Attempt saved.',
            'attempt'       => $attempt,
            'attempts_used' => $attemptsUsed + 1,
            'max_attempts'  => $quiz->max_attempts,
        ], 201);
    }

    // ── Score / attempt history ──────────────────────────
    public function history(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'quiz_id' => 'nullable|integer',
        ]);

        $query = Attempt::where('user_id', $validated['user_id']);

        if (!empty($validated['quiz_id'])) {
            $query->where('quiz_id', $validated['quiz_id']);
        }

        $attempts = $query->latest()->get();

        return response()->json([
            'success'  => true,
            'count'    => $attempts->count(),
            'attempts' => $attempts,
        ]);
    }

    // ── Single attempt detail ────────────────────────────
    public function show($id, Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
        ]);

        $attempt = Attempt::where('id', $id)
            ->where('user_id', $validated['user_id'])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'attempt' => $attempt,
        ]);
    }

    // ── Check if user can still attempt ─────────────────
    public function canAttempt(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'quiz_id' => 'required|integer',
        ]);

        $quiz = Quiz::findOrFail($validated['quiz_id']);

        $attemptsUsed = Attempt::where('user_id', $validated['user_id'])
            ->where('quiz_id', $quiz->id)
            ->count();

        $allowed = ($quiz->max_attempts === 0) || ($attemptsUsed < $quiz->max_attempts);

        return response()->json([
            'success'       => true,
            'allowed'       => $allowed,
            'attempts_used' => $attemptsUsed,
            'max_attempts'  => $quiz->max_attempts,
        ]);
    }
}