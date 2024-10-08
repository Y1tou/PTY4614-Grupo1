<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
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
    public function store(Request $request)//: RedirectResponse
    {
        $request->validate([
            'name' => ['nullable','string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'password' => null, // No almacenar contraseña
        ]);

        event(new Registered($user));

        Auth::login($user);

        // return response('Usuario registrado exitosamente.');
        return redirect()->route('admin.ae-listado-cuentas')->with('success', 'Cuenta creada exitosamente');
}

 // public function showRegistrationForm()

    // public function register(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'run' => 'nullable|integer|max:8',
    //         'name' => 'nullable|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         // 'password' => 'nullable|string|min:8|confirmed', // Confirmación de contraseña
    //         'password' => 'nullable|string',
    //         'carrera' => 'nullable|string|max:60',
    //         'edad' => 'nullable|integer',
    //         'sexo' => 'nullable|in:M,F', // M para masculino, F para femenino
    //     ]);

    //     // $validatedData['password'] = Hash::make($validatedData['password']);

    //     // User::create($validatedData);

    //     return with('success', 'Usuario registrado exitosamente.');
    // }

}


