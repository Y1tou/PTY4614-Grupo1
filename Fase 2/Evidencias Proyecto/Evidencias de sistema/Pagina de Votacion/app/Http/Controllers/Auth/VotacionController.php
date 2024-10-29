<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Votacion;
use Illuminate\Support\Facades\Mail;
use App\Mail\VotacionNotificacion;
use Illuminate\Support\Facades\DB;

class VotacionController extends Controller
{
    public function create()
    {
        return view('admin.votacion');
    }

    public function mostrarVotacionAct()
    {
        $votacion = Votacion::all();
        return view('admin/ae-votaciones-activas', compact('votacion'));
    }

    public function mostrarVotacionHist()
    {
        $votacion = Votacion::all();
        return view('admin/ae-historial-votaciones', compact('votacion'));
    }

    public function detallesVotacion($sigla)
    {
        $votacion = Votacion::where('SIGLA', $sigla)->first();
        return view('admin.ae-detalles-votacion', compact('votacion'));
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'sigla' => 'required|string|max:12',
                'tema' => 'required|string|max:60',
                'descripcion' => 'required|string|max:300',
                'opcion1' => 'required|string|max:30',
                'opcion2' => 'required|string|max:30',
                'opcion3' => 'nullable|string|max:30',
                'opcion4' => 'nullable|string|max:30',
            ]);
            
            // Crear una nueva votación
            $votacion = Votacion::create([
                'SIGLA' => $request->input('sigla'),
                'NOMBRE' => $request->input('tema'),
                'DESCRIPCION' => $request->input('descripcion'),
                'OPC_1' => $request->input('opcion1'),
                'OPC_2' => $request->input('opcion2'),
                'OPC_3' => $request->input('opcion3'),
                'OPC_4' => $request->input('opcion4'),
                'ESTADO' => 1,
            ]);
            
            // Obtener correos de usuarios con TIPO = 2 en la tabla admin
            $adminCorreos = DB::table('admin')->where('TIPO', 2)->pluck('CORREO');
            
            // Obtener correos de la tabla USERS
            $userCorreos = DB::table('USERS')->pluck('email');
            
            // Unir ambos arrays de correos y eliminar duplicados
            $todosLosCorreos = $adminCorreos->merge($userCorreos)->unique();
            
            // Enviar el correo a todos los administradores y usuarios
            foreach ($todosLosCorreos as $correo) {
                Mail::to($correo)->send(new VotacionNotificacion($request->input('sigla'), 'crear')); // Indica que se está creando
            }
            
            // Redirigir con mensaje de éxito
            return redirect()->route('votacion.create')->with('success', 'Votación creada exitosamente y correos enviados.');
            
        } catch (\Exception $e) {
            // Atrapar cualquier error y redirigir con un mensaje de error
            return redirect()->route('votacion.create')->with('error', 'Ocurrió un problema al crear la votación. Por favor, inténtalo de nuevo.');
        }
    }

    public function finalizarVotacion($sigla)
    {
        $votacion = Votacion::where('SIGLA', $sigla)->first();

        if ($votacion) {
            $votacion->ESTADO = 0; // Cambiar el estado a finalizada
            $votacion->save();

            // Obtener correos de usuarios con TIPO = 2 en la tabla admin
            $adminCorreos = DB::table('admin')->where('TIPO', 2)->pluck('CORREO');
            
            // Obtener correos de la tabla USERS
            $userCorreos = DB::table('USERS')->pluck('email');

            // Unir ambos arrays de correos y eliminar duplicados
            $todosLosCorreos = $adminCorreos->merge($userCorreos)->unique();

            // Enviar el correo a todos los administradores y usuarios
            foreach ($todosLosCorreos as $correo) {
                Mail::to($correo)->send(new VotacionNotificacion($sigla, 'eliminar')); // Indica que se está eliminando
            }

            return redirect()->route('admin.ae-historial-votaciones')->with('success', 'La votación se ha finalizado correctamente y correos enviados.');
        }

        return redirect()->route('admin.ae-historial-votaciones')->with('error', 'No se pudo finalizar la votación.');
    }
}
