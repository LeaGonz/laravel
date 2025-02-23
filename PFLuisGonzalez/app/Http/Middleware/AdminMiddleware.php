<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Verifica se o utilizador está autenticado e se é administrador (user_type = 1)
        if (Auth::check() && Auth::user()->user_type == 1) {
            return $next($request);
        }

        return redirect()->route('home')->with('message', 'Acesso negado!');
    }
}
