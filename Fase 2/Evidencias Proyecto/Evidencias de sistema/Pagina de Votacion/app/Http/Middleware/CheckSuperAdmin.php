<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {        
        // Verificar si el usuario está autenticado como admin
        $user = Auth::guard('admin')->user();

        // Verificar si el admin es de tipo superadmin (TIPO_SUPERADMIN = 1)
        if ($user && $user->TIPO == 1) {
            return $next($request); // Permitir acceso
        }

        // Si no es superadmin, redirigir al inicio
        return redirect('/');
    }
}
