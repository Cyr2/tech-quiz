<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAuthenticated
{
    /**
     * Gérer une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        
        // Vérifiez simplement si un token existe
        // Dans un environnement de production, vous voudriez vérifier le token par rapport à une liste valide
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}