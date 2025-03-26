<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Quiz::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);

        $test = Quiz::where('title', $request->title)->first();
        if ($test) {
            return response()->json([
                'error' => 'Ce quiz existe déjà',
            ], 400);
        }

        $quiz = Quiz::create([
            'quiz_id' => Str::uuid(),
            'title' => $request->title,
            'date' => $request->date,
        ]);

        return response()->json([
            'sucess' => 'Quiz créé avec succès',
            'quiz' => [
                'id' => $quiz->quiz_id,
                'title' => $quiz->title,
                'date' => $quiz->date,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Quiz::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return response()->json([
            'message' => 'Quiz modifié avec succès',
            'quiz' => [
                'id' => $quiz->quiz_id,
                'name' => $quiz->name,
                'date' => $quiz->date,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->forceDelete();

        return response()->json([
            'message' => 'Quiz supprimé avec succès',
        ]);
    }
}
