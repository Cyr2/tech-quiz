<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Str;

class AnswerController extends Controller
{
    /**
     * Affichage de la liste des réponses.
     */
    public function index()
    {
        return Answer::all();
    }

    /**
     * Stocker une nouvelle réponse.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'is_correct' => 'required',
            'question_id' => 'required',
        ]);

        $answer = Answer::create([
            'label' => $request->label,
            'is_correct' => $request->is_correct,
            'question_id' => $request->question_id,
        ]);

        return response()->json([
            'sucess' => 'Réponse créée avec succès',
            'answer' => [
                'id' => $answer->answer_id,
                'label' => $answer->label,
                'is_correct' => $answer->is_correct,
                'question_id' => $answer->question_id,
            ],
        ]);
    }

    /**
     * Afficher la réponse spécifiée.
     */
    public function show(string $id)
    {
        return Answer::findOrFail($id);
    }
    
    public function showByQuestion(string $id)
    {
        return Answer::where('question_id', $id)->get();
    }

    /**
     * Mettre à jour la réponse spécifiée.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => 'required',
            'is_correct' => 'required',
            'question_id' => 'required',
        ]);

        $answer = Answer::where('answer_id', $id)->first();

        if(!$answer) {
            $answer = Answer::create([
                'label' => $request->label,
                'is_correct' => $request->is_correct,
                'question_id' => $request->question_id,
            ]);
        }
        else{

        $answer->update([
            'label' => $request->label,
            'is_correct' => $request->is_correct,
            'question_id' => $request->question_id,
        ]);
        }

        return response()->json([
            'message' => 'Réponse modifiée avec succès',
            'answer' => [
                'id' => $answer->answer_id,
                'label' => $answer->label,
                'is_correct' => $answer->is_correct,
                'question_id' => $answer->question_id,
            ],
        ]);
    }

    /**
     * Supprimer la réponse spécifiée.
     */
    public function destroy(string $id)
    {
        $answer = Answer::where('answer_id', $id)->first();
        $answer->forceDelete();

        return response()->json([
            'message' => 'Réponse supprimée avec succès',
        ]);
    }
}
