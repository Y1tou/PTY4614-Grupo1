<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; 
use App\Models\User; 

class VerificarCorreoController extends Controller
{
    public function verificar(Request $request)
    {
        // Validar el correo electrónico
        $request->validate([
            'email' => 'required|email',
        ]);

        $correo = $request->input('email');

        // Verificar si el correo existe en Admin o User
        $existeAdmin = Admin::where('correo', $correo)->where('tipo', 2)->exists();
        $existeUser = User::where('email', $correo)->exists();

        if ($existeAdmin || $existeUser) {
            // El correo existe, puedes redirigir a la API de Google
            return view('welcome')->with('correoValido', true);
        } else {
            // El correo no existe, mostrar mensaje de error
            return view('welcome')->with('correoValido', false);
        }
    }
}