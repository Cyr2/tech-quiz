<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    /**
     * Affichage de la liste des quiz.
     */
    public function index()
    {
        return Quiz::all();
    }

    /**
     * Stocker un nouveau quiz.
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
     * Afficher le quiz spécifié.
     */
    public function show(string $id)
    {
        return Quiz::where('quiz_id', $id)->first();
    }

    /**
     * Mettre à jour le quiz spécifié.
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
     * Supprimer le quiz spécifié.
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
