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
    public function create()
    {
        return view('create-quiz');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*' => 'nullable|string',
            'questions.*.correct' => 'required|numeric',
        ]);

        $quiz = Quiz::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        foreach ($request->questions as $qData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $qData['question_text'],
            ]);
            foreach ($qData['options'] as $index => $optionText) {
                if (empty(trim($optionText))) continue;
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                    'is_correct' => ($index == $qData['correct']),
                ]);
            }
        }

        // After creating, go to the quiz edit page so they can take it right away
        return redirect()->route('take-quiz.show', $quiz->id)
            ->with('success', 'Quiz "' . $quiz->title . '" created successfully!');
    }

    public function index()
    {
        $quizzes = Quiz::all();
        return view('quiz.index', compact('quizzes'));
    }

    public function edit($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        return view('quiz.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        // Stay on edit page after saving
        return redirect()->route('quiz.edit', $id)->with('success', 'Quiz updated!');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('quiz.index')->with('success', 'Quiz deleted!');
    }

    public function destroyQuestion($id)
    {
        $question = Question::findOrFail($id);
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('quiz.edit', $quizId)->with('success', 'Question deleted!');
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update(['question_text' => $request->question_text]);
        foreach ($request->options as $optionId => $optionText) {
            Option::where('id', $optionId)->update(['option_text' => $optionText]);
        }
        Option::where('question_id', $id)->update(['is_correct' => false]);
        Option::where('id', $request->correct)->update(['is_correct' => true]);
        // Stay on edit page after saving question
        return redirect()->route('quiz.edit', $question->quiz_id)->with('success', 'Question updated!');
    }

    public function takeQuizList()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('take-quiz', compact('quizzes'));
    }

    public function takeQuiz($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        return view('quiz.take', compact('quiz'));
    }

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
            }
        }

        $total = $quiz->questions->count();
        $score = $total > 0 ? round(($correct / $total) * 100) : 0;

        Attempt::updateOrCreate(
            ['user_id' => Auth::id(), 'quiz_id' => $id],
            ['total_questions' => $total, 'correct_answers' => $correct, 'score' => $score]
        );

        return redirect()->route('scores')->with('result', [
            'title' => $quiz->title,
            'score' => $score,
            'correct' => $correct,
            'total' => $total,
        ]);
    }
}