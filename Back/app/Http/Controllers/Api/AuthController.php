<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Les identifiants fournis sont incorrects.'
            ], 401);
        }

        $token = Str::random(60);

        // Vous pouvez stocker le token dans la base de données ou dans un cache si nécessaire

        return response()->json([
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user->user_id,
                'email' => $user->email,
                'role_id' => $user->role_id,
            ],
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(User::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'Cet email est déjà utilisé.'
            ], 400);
        }

        $user = User::create([
            'user_id' => Str::uuid(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        $token = Str::random(60);

        return response()->json([
            'message' => 'Utilisateur enregistré avec succès',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
            ],
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        // Ici, vous pouvez invalider le token si vous le stockez quelque part
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
