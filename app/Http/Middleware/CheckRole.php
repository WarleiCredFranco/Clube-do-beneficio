<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Verifica se o usuário está autenticado e tem um papel permitido
        if (!$user || !in_array($user->role, $roles)) {
            return redirect('/'); // Redirecionar para a página inicial ou outro local apropriado
        }

        // Verifica se o papel do usuário é "gerente"
        if ($user->role === 'gerente') {
            return $next($request);
        }

        // Verifica se o papel do usuário é "cliente"
        if ($user->role === 'cliente') {
            return $next($request);
        }

        return redirect('/');
        
        // Redirecionar em outros casos
    }


    
}
