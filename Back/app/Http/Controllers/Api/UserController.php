<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserController
{
    /**
     * Affichage de la liste des utilisateurs.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Stocker un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        if(User::where('email', $request->email)->exists()) {
            return response()->json([
                'error' => 'Cet email est déjà utilisé.'
            ], 400);
        }
        if(User::where('username', $request->username)->exists()) {
            return response()->json([
                'error' => 'Ce nom d\'utilisateur est déjà utilisé.'
            ], 400);
        }

        $user = User::create([
            'user_id' => Str::uuid(),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return response()->json([
            'success' => 'Utilisateur créé avec succès',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role_id' => $user->role_id,
            ],
        ]);
    }

    /**
     * Afficher l'utilisateur spécifié.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Mettre à jour l'utilisateur spécifié.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return response()->json([
            'message' => 'Utilisateur modifié avec succès',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'username' => $user->username,
                'role_id' => $user->role_id,
            ],
        ]);
    }

    /**
     * Supprimer l'utilisateur spécifié.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->forceDelete();   

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès',
        ]);
    }
}
