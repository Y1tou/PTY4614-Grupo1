<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)//: Response
    {
        // Verificar si el usuario está autenticado como admin
        $user = Auth::guard('admin')->user();

        // Verificar si el admin es de tipo 2 (TIPO_ADMIN_AE = 2)
        if ($user && $user->TIPO == 2) {
            return $next($request); // Permitir acceso
        }

        // Si no es admin tipo 2, redirigir al inicio
        return redirect('/');
    }
}
