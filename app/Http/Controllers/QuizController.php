<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function create()
    {
        return view('create-quiz');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                          => 'required|string|max:255',
            'description'                    => 'nullable|string',
            'questions'                      => 'required|array|min:1',
            'questions.*.question_text'      => 'required|string',
            'questions.*.options'            => 'required|array|min:2',
            'questions.*.options.*'          => 'required|string',
            'questions.*.correct'            => 'required|integer',
        ]);

        $quiz = Quiz::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        foreach ($request->questions as $qData) {
            $question = Question::create([
                'quiz_id'       => $quiz->id,
                'question_text' => $qData['question_text'],
            ]);

            foreach ($qData['options'] as $index => $optionText) {
                if (empty(trim($optionText))) continue;

                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                    'is_correct'  => ($index == $qData['correct']),
                ]);
            }
        }

        return redirect()->route('dashboard')
            ->with('success', 'Quiz "' . $quiz->title . '" created successfully!');
    }
}
