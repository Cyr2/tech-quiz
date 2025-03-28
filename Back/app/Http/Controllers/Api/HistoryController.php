<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History; 

class HistoryController extends Controller
{
    /**
     * Affichage de la liste des historiques.
     */
    public function index()
    {
        return History::all();
    }

    /**
     * Stocker un nouvel historique.
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
     * Afficher l'historique spécifié.
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
     * Mettre à jour la ressource spécifiée.
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
     * Supprimer l'historique spécifiée.
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
