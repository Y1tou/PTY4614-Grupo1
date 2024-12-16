<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWebView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtener el User-Agent del request
        $userAgent = $request->header('User-Agent');

        // Verificar si el User-Agent contiene indicios de un WebView
        if (stripos($userAgent, 'wv') !== false || stripos($userAgent, 'WebView') !== false) {
            // Responder con un mensaje y código HTTP 403
            return response('Por favor, abre esta página en un navegador seguro.', Response::HTTP_FORBIDDEN);
        }

        // Si no es un WebView, permitir el acceso al siguiente middleware o controlador
        return $next($request);
    }
}
