<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $roles)
{
    $roles = explode(',', $roles);

    if (Auth::check()) {
        $userRoles = Auth::user()->roles->pluck('name')->toArray();

        if (!array_intersect($roles, $userRoles)) {
            // Devolver un error 403 si no tiene un rol permitido
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    } else {
        // Si no está autenticado, redirigir al inicio de sesión
        return redirect('/login');
    }

    return $next($request);
}

}
