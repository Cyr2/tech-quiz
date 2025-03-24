<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Answer::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'is_correct' => 'required',
            'question_id' => 'required',
        ]);

        $answer = Answer::create([
            'answer_id' => Str::uuid(),
            'label' => $request->label,
            'is_correct' => $request->is_correct,
            'question_id' => $request->question_id,
        ]);

        return response()->json([
            'message' => 'Réponse créée avec succès',
            'answer' => [
                'id' => $answer->answer_id,
                'label' => $answer->label,
                'is_correct' => $answer->is_correct,
                'question_id' => $answer->question_id,
            ],
        ]);
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => 'required',
            'is_correct' => 'required',
            'question_id' => 'required',
        ]);

        $answer = Answer::findOrFail($id);
        $answer->update([
            'label' => $request->label,
            'is_correct' => $request->is_correct,
            'question_id' => $request->question_id,
        ]);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return response()->json([
            'message' => 'Réponse supprimée avec succès',
        ]);
    }
}
