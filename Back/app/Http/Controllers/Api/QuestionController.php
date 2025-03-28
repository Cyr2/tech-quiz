<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Affichage de la liste des questions.
     */
    public function index()
    {
        return Question::all();
    }

    /**
     * Stocker une nouvelle question.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'quiz_id' => 'required',
        ]);

        $question = Question::create([
            'question_id' => Str::uuid(),
            'label' => $request->label,
            'quiz_id' => $request->quiz_id,
        ]);

        return response()->json([
            'sucess' => 'Question créée avec succès',
            'question' => [
                'id' => $question->question_id,
                'label' => $question->label,
                'quiz_id' => $question->quiz_id,
            ],
        ]);
    }

    /**
     * Afficher la question spécifiée.
     */
    public function show(string $id)
    {
        return Question::findOrFail($id);
    }

    public function showByQuiz(string $id)
    {
        return Question::where('quiz_id', $id)->get();
    }

    /**
     * Mettre à jour la question spécifiée.
     */
    public function update(Request $request, string $id)
    {

        if(!$request->label || !$request->quiz_id) {
            return response()->json([
                'message' => 'Veuillez remplir tous les champs',
            ]);
        }

        $request->validate([
            'label' => 'required',
            'quiz_id' => 'required',
        ]);

        $question = Question::where('question_id', $id)->first();

        if (!$question) {
            $question = Question::create([
                'question_id' => $id,	
                'label' => $request->label,
                'quiz_id' => $request->quiz_id,
            ]);
        }
        else{
        $question->update([
            'label' => $request->label,
            'quiz_id' => $request->quiz_id,
        ]);
        }

        return response()->json([
            'message' => 'Question modifiée avec succès',
            'question' => [
                'id' => $question->question_id,
                'label' => $question->label,
                'quiz_id' => $question->quiz_id,
            ],
        ]);
    }

    /**
     * Supprimer la question spécifiée.
     */
    public function destroy(string $id)
    {
        $question = Question::where('question_id', $id)->first();
        
        $question->forceDelete();
        
        return response()->json([
            'message' => 'Question supprimée avec succès',
        ]);
    }
}
