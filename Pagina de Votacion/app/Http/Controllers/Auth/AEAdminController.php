<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Controlador que será utilizado para la gestión consejeros y de votaciones

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

    public function mostrarVotacionAct()
    {
        return view('admin/ae-votaciones-activas');
    }

    public function mostrarVotacionHist()
    {
        return view('admin/ae-historial-votaciones');
    }

    // Actualizar datos Consejero
    public function update(Request $request)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'run' => 'nullable|string|max:8',
            'nombre' => 'nullable|string|max:255',
            'correo' => 'required|email|max:255',
            'carrera' => 'nullable|string|max:255',
            'edad' => 'nullable|string|max:2',
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
