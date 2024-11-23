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
                'run' => ['required', 'string', 'min:7', 'max:9', 'regex:/^\d+$/'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class,'regex:/^[a-zA-Z]+(\.[a-zA-Z]+)?@duocuc\.cl$/'],
                'carrera' => ['required', 'string', 'max:60'],
                'edad' => ['required', 'integer', 'min:18', 'max:99'],
                'sexo' => ['required','in:M,F'],
            ]);

            $user = User::create([
                'run' => $request->run,
                'name' => $request->name,
                'email' => $request->email,
                'password' => null, // No almacenar contraseña
                'carrera' => $request->carrera,
                'edad' => $request->edad, 
                'sexo' => $request->sexo, 
            ]);

            return redirect()->route('admin.ae-listado-cuentas')->with('success', 'Cuenta creada exitosamente');
        } catch (\Exception $e) {
            // Registrar el error en laravel.log
            Log::error('Error en la función registro de usuario(consejero): ' . $e->getMessage(), [
                'linea' => $e->getLine(),
                'archivo' => $e->getFile(),
                'traza' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.ae-home')->with('error', 'Ocurrió un problema al registrar. Por favor, verifique los datos inténtalo de nuevo.');
        }
    }

}


