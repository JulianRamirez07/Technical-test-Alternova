<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y tiene el rol de administrador
        if ($request->user() && $request->user()->role_id === 1) {
            return $next($request);
        }

        // Si el usuario no es administrador, retornar una respuesta no autorizada
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
