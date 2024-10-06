<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        // // Verificar si el usuario autenticado es SUPERADMIN
        // if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->TIPO == 1) {
        //     return $next($request);  // Permitir acceso a los SUPERADMIN
        // }

        // // Redirigir a la página de login si no es SUPERADMIN
        // return redirect('/admin/login')->withErrors('No tienes permisos para acceder a esta sección.');
    }
}
