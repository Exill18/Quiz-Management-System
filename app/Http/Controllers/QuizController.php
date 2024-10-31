<?php

// app/Http/Controllers/QuizController.php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Tag;
use App\Models\QuizParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('tags')->latest()->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('quizzes.create', compact('tags'));
    }

    // app/Http/Controllers/QuizController.php

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'exercises' => 'array|required',
            'exercises.*.question' => 'string|required',
            'exercises.*.solution' => 'string|required',
            'exercises.*.score' => 'integer|required',
        ]);

        $quiz = Quiz::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => Auth::id(),
        ]);

        // Handle tags
        if (!empty($data['tags'])) {
            $tags = explode(',', $data['tags']);
            $tagIds = collect($tags)->map(fn($tagName) => Tag::firstOrCreate(['name' => trim($tagName)])->id);
            $quiz->tags()->sync($tagIds);
        }

        // Store exercises with solutions and scores
        foreach ($data['exercises'] as $exercise) {
            $quiz->exercises()->create([
                'question' => $exercise['question'],
                'solution' => $exercise['solution'],
                'score' => $exercise['score'],
            ]);
        }

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }


    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'answers' => 'array|required',
            'answers.*' => 'string',
        ]);

        $totalScore = 0;

        // Calculate score by comparing answers to solutions
        foreach ($quiz->exercises as $exercise) {
            if (isset($data['answers'][$exercise->id]) && $data['answers'][$exercise->id] === $exercise->solution) {
                $totalScore += $exercise->score;
            }
        }

        // Create a new participant record in quiz_user
        QuizParticipant::create([
            'quiz_id' => $quiz->id,
            'user_id' => Auth::id(), // Optional, will be null for guests
            'username' => $data['username'],
            'score' => $totalScore,
        ]);

        return redirect()->route('quizzes.results', $quiz);
    }

    public function results(Quiz $quiz)
    {
        $results = $quiz->participants; // Fetch participants for this quiz

        return view('quizzes.results', compact('quiz', 'results'));
    }

    public function shared($slug)
    {
        $quiz = Quiz::where('slug', $slug)->firstOrFail();
        return view('quizzes.shared', compact('quiz'));
    }

    

    
    public function submitSharedQuiz(Request $request, $slug)
    {
        $quiz = Quiz::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'username' => 'required|string|max:255',
            'answers' => 'array|required',
            'answers.*' => 'string',
        ]);

        $totalScore = 0;

        foreach ($quiz->exercises as $exercise) {
            if (isset($data['answers'][$exercise->id]) && $data['answers'][$exercise->id] === $exercise->solution) {
                $totalScore += $exercise->score;
            }
        }

        QuizParticipant::create([
            'quiz_id' => $quiz->id,
            'user_id' => Auth::id(), // Optional, will be null for guests
            'username' => $data['username'],
            'score' => $totalScore,
        ]);

        return redirect()->route('quizzes.results', $quiz);
    }

    public function edit(Quiz $quiz)
    {
        $tags = Tag::all();
        return view('quizzes.updateQuiz', compact('quiz', 'tags'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'exercises' => 'array|required',
            'exercises.*.question' => 'string|required',
            'exercises.*.solution' => 'string|required',
            'exercises.*.score' => 'integer|required',
        ]);

        $quiz->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        // Handle tags
        if (!empty($data['tags'])) {
            $tags = explode(',', $data['tags']);
            $tagIds = collect($tags)->map(fn($tagName) => Tag::firstOrCreate(['name' => trim($tagName)])->id);
            $quiz->tags()->sync($tagIds);
        }

        // Update exercises with solutions and scores
        $quiz->exercises()->delete(); // Delete existing exercises
        
        foreach ($data['exercises'] as $exercise) {
            $quiz->exercises()->create([
                'question' => $exercise['question'],
                'solution' => $exercise['solution'],
                'score' => $exercise['score'],
            ]);
        }
        //Update Results by deleting the old 
        $quiz->participants()->delete();

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Quiz updated successfully!');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully!');
    }



}
