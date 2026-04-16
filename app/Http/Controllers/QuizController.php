<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Attempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // ── Create Quiz ──────────────────────────────────────
    public function create()
    {
        return view('create-quiz');
    }

    // ── Store Quiz ───────────────────────────────────────
    public function store(Request $request)
    {
        dd($request->all()); // This will show all the data being sent in the form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.type' => 'required|in:multiple_choice,identification',
            'questions.*.correct_answer' => 'nullable|string',
            'questions.*.options' => 'nullable|array',
            'questions.*.correct' => 'nullable|integer',
        ]);

        // Create the quiz
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        // Store each question
        foreach ($request->questions as $questionData) {
            $type = $questionData['type'];

            // Create question
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $questionData['question_text'],
                'type' => $type,
                'correct_answer' => $type === 'identification' 
                    ? ($questionData['correct_answer'] ?? null) 
                    : null,
            ]);

            // Store options for multiple choice
            if ($type === 'multiple_choice') {
                foreach ($questionData['options'] as $index => $optionText) {
                    if (trim($optionText) === '') {
                        continue;
                    }

                    Option::create([
                        'question_id' => $question->id,
                        'option_text' => $optionText,
                        'is_correct' => isset($questionData['correct']) && (int)$questionData['correct'] === $index,
                    ]);
                }
            }
        }

        return redirect()->route('create-quiz')->with('success', 'Quiz created successfully.');
    }

    // ── Index (All Quizzes) ───────────────────────────────
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quiz.index', compact('quizzes'));
    }

    // ── Edit Quiz ────────────────────────────────────────
    public function edit($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        return view('quiz.edit', compact('quiz'));
    }

    // ── Update Quiz ──────────────────────────────────────
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('quiz.edit', $id)->with('success', 'Quiz updated!');
    }

    // ── Delete Quiz ──────────────────────────────────────
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('quiz.index')->with('success', 'Quiz deleted!');
    }

    // ── Delete Question ──────────────────────────────────
    public function destroyQuestion($id)
    {
        $question = Question::findOrFail($id);
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('quiz.edit', $quizId)->with('success', 'Question deleted!');
    }

    // ── Update Question ──────────────────────────────────
    public function updateQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update(['question_text' => $request->question_text]);

        foreach ($request->options as $optionId => $optionText) {
            Option::where('id', $optionId)->update(['option_text' => $optionText]);
        }

        Option::where('question_id', $id)->update(['is_correct' => false]);
        Option::where('id', $request->correct)->update(['is_correct' => true]);

        return redirect()->route('quiz.edit', $question->quiz_id)->with('success', 'Question updated!');
    }

    // ── Take Quiz List ───────────────────────────────────
    public function takeQuizList()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('take-quiz', compact('quizzes'));
    }

    // ── Take Quiz ────────────────────────────────────────
    public function takeQuiz($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        return view('quiz.take', compact('quiz'));
    }

    // ── Submit Quiz ──────────────────────────────────────
    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        $answers = $request->answers ?? [];
        $correct = 0;

        foreach ($quiz->questions as $question) {
            $selectedOptionId = $answers[$question->id] ?? null;
            if ($selectedOptionId) {
                $option = Option::find($selectedOptionId);
                if ($option && $option->is_correct) {
                    $correct++;
                }
            } elseif ($question->type === 'identification') {
                // For identification, compare the answer text
                $submittedAnswer = strtolower(trim($answers[$question->id]));
                if ($submittedAnswer === strtolower(trim($question->correct_answer))) {
                    $correct++;
                }
            }
        }

        $total = $quiz->questions->count();
        $score = $total > 0 ? round(($correct / $total) * 100) : 0;

        Attempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $id,
            'total_questions' => $total,
            'correct_answers' => $correct,
            'score' => $score,
        ]);

        return redirect()->route('scores')->with('result', [
            'title' => $quiz->title,
            'score' => $score,
            'correct' => $correct,
            'total' => $total,
        ]);
    }

    // ── Scores Page ──────────────────────────────────────
    public function scores()
    {
        $attempts = auth()->user()->attempts()
            ->with('quiz')
            ->latest()
            ->get()
            ->unique('quiz_id')
            ->values();
        return view('scores', compact('attempts'));
    }
}