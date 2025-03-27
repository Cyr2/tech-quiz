<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Question::all();
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if(!$request->label || !$request->quiz_id) {
            return response()->json([
                'message' => 'Veuilllllllez remplir tous les champs',
            ]);
        }

        $request->validate([
            'label' => 'required',
            'quiz_id' => 'required',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'label' => $request->label,
            'quiz_id' => $request->quiz_id,
        ]);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::findOrFail($id)->forceDelete();

        return response()->json([
            'message' => 'Question supprimée avec succès',
        ]);
    }
}
