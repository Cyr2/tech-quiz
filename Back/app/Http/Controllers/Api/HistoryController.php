<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History; // Ensure the History model is imported

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return History::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'history_id' => 'required',
            'date' => 'required',
            'score' => 'required',
            'user_id' => 'required',
            'quiz_id' => 'required',
        ]);

        $history = History::create([
            'history_id' => $request->history_id,
            'date' => $request->date,
            'score' => $request->score,
            'user_id' => $request->user_id,
            'quiz_id' => $request->quiz_id,
        ]);

        return response()->json([
            'message' => 'Historique créé avec succès',
            'history' => [
                'id' => $history->history_id,
                'date' => $history->date,
                'score' => $history->score,
                'user_id' => $history->user_id,
                'quiz_id' => $history->quiz_id,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return History::where('history_id', $id)->first();
    }

    public function showByUser(string $id)
    {
        return History::where('user_id', $id)->get();
    }

    public function showByQuiz(string $id)
    {
        return History::where('quiz_id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'history_id' => 'required',
            'date' => 'required',
            'score' => 'required',
            'user_id' => 'required',
            'quiz_id' => 'required',
        ]);

        $history = History::findOrFail($id);
        $history->update([
            'history_id' => $request->history_id,
            'date' => $request->date,
            'score' => $request->score,
            'user_id' => $request->user_id,
            'quiz_id' => $request->quiz_id,
        ]);

        return response()->json([
            'message' => 'Historique modifié avec succès',
            'history' => [
                'id' => $history->history_id,
                'date' => $history->date,
                'score' => $history->score,
                'user_id' => $history->user_id,
                'quiz_id' => $history->quiz_id,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $history = History::findOrFail($id);

        $history->forceDelete();

        return response()->json([
            'message' => 'Historique supprimé avec succès',
        ]);
    }
}
