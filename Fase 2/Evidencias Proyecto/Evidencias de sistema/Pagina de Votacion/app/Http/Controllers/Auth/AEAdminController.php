<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Votacion; 

// Controlador que será utilizado para la gestión consejeros

class AEAdminController extends Controller
{
    public function showAEHome()
    {
        return view('admin/ae-home');
    }
    
    public function mostrarListadoAE()
    {
        $users = User::all(); // Obtener todos los administradores
        return view('admin.ae-listado-cuentas', compact('users'));
    }

    // Actualizar datos Consejero
    public function update(Request $request)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'run' => 'required|string|min:7|max:9|regex:/^\d+$/',
            'nombre' => 'nullable|string|max:255',
            'correo' => 'required|email|max:255|regex:/^[a-zA-Z]+(\.[a-zA-Z]+)?@duocuc\.cl$/',
            'carrera' => 'nullable|string|max:60',
            'edad' => 'nullable|integer|min:18|max:99',
            'sexo' => 'in:M,F',
        ]);

        // Buscar al usuario por ID
        $user = User::find($request->id);
        
        // Actualizar los campos
        $user->run = $request->run;
        $user->name = $request->nombre;
        $user->email = $request->correo;
        $user->carrera = $request->carrera;
        $user->edad = $request->edad;
        $user->sexo = $request->sexo;
        
        // Guardar los cambios
        $user->save();

        // Redirigir a la lista de cuentas con un mensaje de éxito
        return redirect()->route('admin.ae-listado-cuentas')->with('success', 'Datos actualizados exitosamente.');
    }

    public function eliminarCuenta($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Eliminar el Usuario

        return redirect()->route('admin.ae-listado-cuentas')->with('success', 'Datos eliminados con éxito.');
    }
}
