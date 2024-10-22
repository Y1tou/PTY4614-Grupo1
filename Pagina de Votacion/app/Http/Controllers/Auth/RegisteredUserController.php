<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    try {
        $request->validate([
            'run' => ['required', 'string', 'max:9', 'regex:/^\d+$/'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'carrera' => ['nullable', 'string', 'max:255'],
            'edad' => ['nullable', 'integer', 'min:18', 'max:99'], // Corregido para validar números entre 1 y 99
            'sexo' => ['nullable','in:M,F'],
        ]);

        $user = User::create([
            'run' => $request->run,
            'name' => $request->name,
            'email' => $request->email,
            'password' => null, // No almacenar contraseña
            'carrera' => $request->carrera,
            'edad' => $request->edad, // Corregido
            'sexo' => $request->sexo, // Corregido
        ]);

        return redirect()->route('admin.ae-listado-cuentas')->with('success', 'Cuenta creada exitosamente');
    } catch (\Exception $e) {
        // Atrapar cualquier error y redirigir con un mensaje de error
        return redirect()->route('admin.ae-home')->with('error', 'Ocurrió un problema al registrar. Por favor, inténtalo de nuevo.');
    }
}


}


