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
            'name' => 'required',
            'date' => 'required',
        ]);

        $quiz = Quiz::create([
            'quiz_id' => Str::uuid(),
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return response()->json([
            'message' => 'Quiz créé avec succès',
            'quiz' => [
                'id' => $quiz->quiz_id,
                'name' => $quiz->name,
                'date' => $quiz->date,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Quiz::where('quiz_id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if(!$request->title || !$request->date) {
            return response()->json([
                'error' => 'Veuillez remplir tous les champs',
            ]);
        }

        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);

        

        $quiz = Quiz::findOrFail($id);
        
        if(!$quiz) {
            return response()->json([
                'error' => 'Quiz non trouvé',
            ]);
        }

        $quiz->update([
            'title' => $request->title,
            'date' => $request->date,
        ]);

        return response()->json([
            'success' => 'Quiz modifié avec succès',
            'quiz' => [
                'id' => $quiz->quiz_id,
                'title' => $quiz->title,
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
