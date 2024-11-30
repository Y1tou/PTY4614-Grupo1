<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Votacion;
use App\Models\Voto;
use App\Models\User;
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
        $votos = Voto::where('SIGLA', $sigla)->get();

        $countOP1 = Voto::where('SIGLA', $sigla)->where('OPCION_VOTADA', $votacion->OPC_1)->count();
        $countOP2 = Voto::where('SIGLA', $sigla)->where('OPCION_VOTADA', $votacion->OPC_2)->count();
        $countOP3 = Voto::where('SIGLA', $sigla)->where('OPCION_VOTADA', $votacion->OPC_3)->count();
        $countOP4 = Voto::where('SIGLA', $sigla)->where('OPCION_VOTADA', $votacion->OPC_4)->count();

        $countAllUsers = User::count();

        $consejerosOP1 = $votos->where('OPCION_VOTADA', $votacion->OPC_1)->pluck('RUN');
        $consejerosOP2 = $votos->where('OPCION_VOTADA', $votacion->OPC_2)->pluck('RUN');
        $consejerosOP3 = $votos->where('OPCION_VOTADA', $votacion->OPC_3)->pluck('RUN');
        $consejerosOP4 = $votos->where('OPCION_VOTADA', $votacion->OPC_4)->pluck('RUN');

        $nombresOP1 = User::whereIn('run', $consejerosOP1)->pluck('name')->map(function($name){return ucwords(strtolower($name));});
        $nombresOP2 = User::whereIn('run', $consejerosOP2)->pluck('name')->map(function($name){return ucwords(strtolower($name));});
        $nombresOP3 = User::whereIn('run', $consejerosOP3)->pluck('name')->map(function($name){return ucwords(strtolower($name));});
        $nombresOP4 = User::whereIn('run', $consejerosOP4)->pluck('name')->map(function($name){return ucwords(strtolower($name));});

        // Obtener los RUN que ya han votado
        $runVotantes = $votos->pluck('RUN');

        // Filtrar usuarios que no han votado
        $sinVotar = User::whereNotIn('run', $runVotantes)->pluck('name')->map(function($name){return ucwords(strtolower($name));});

        $maxRows = max($nombresOP1->count(), $nombresOP2->count(), $nombresOP3->count(), $nombresOP4->count());
        
        $usuarioSinVotar = $countAllUsers - $maxRows;

        return view('admin.ae-detalles-votacion', compact('votacion', 'votos', 'countOP1','countOP2','countOP3','countOP4','nombresOP1', 'nombresOP2', 'nombresOP3', 'nombresOP4', 'maxRows', 'usuarioSinVotar', 'sinVotar'));
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
            // Registrar el error en laravel.log
            // Log::error('Error en la función crear votacion: ' . $e->getMessage(), [
            //     'linea' => $e->getLine(),
            //     'archivo' => $e->getFile(),
            //     'traza' => $e->getTraceAsString(),
            // ]);
            // Redirigir con mensaje de error
            return redirect()->route('votacion.create')->with('error', 'Ocurrió un problema al crear la votación. Por favor, inténtalo de nuevo.');
        }
    }

    public function finalizarVotacion(Request $request, $sigla)
    {
        try {
            $validated = $request->validate([
                'opc_ganadora' => 'required|string|max:30'
            ]);
        
            $votacion = Votacion::where('SIGLA', $sigla)->first();
        
            if ($votacion) {
                // Establecer opción ganadora y cambiar el estado a finalizada
                $votacion->GANADOR = $validated['opc_ganadora'];
                $votacion->ESTADO = 0; // Cambiar estado a finalizada
                $votacion->save();
        
                // Obtener correos de usuarios con TIPO = 2 en la tabla admin
                $adminCorreos = DB::table('admin')->where('TIPO', 2)->pluck('CORREO');
                
                // Obtener correos de la tabla USERS
                $userCorreos = DB::table('USERS')->pluck('email');
        
                // Unir ambos arrays de correos y eliminar duplicados
                $todosLosCorreos = $adminCorreos->merge($userCorreos)->unique();
        
                // Enviar el correo a todos los administradores y usuarios
                foreach ($todosLosCorreos as $correo) {
                    Mail::to($correo)->send(new VotacionNotificacion($sigla, 'eliminar')); // Enviar correo de finalización
                }
        
                return redirect()->route('admin.ae-historial-votaciones')->with('success', 'La votación se ha finalizado correctamente y correos enviados.');
            }
            return redirect()->route('admin.ae-historial-votaciones')->with('error', 'No se pudo finalizar la votación.');

        } catch (\Exception $e) {
            // Registrar el error en laravel.log
            // Log::error('Error en la función crear votacion: ' . $e->getMessage(), [
            //     'linea' => $e->getLine(),
            //     'archivo' => $e->getFile(),
            //     'traza' => $e->getTraceAsString(),
            // ]);
            // Redirigir con mensaje de error
            return redirect()->route('admin.ae-historial-votaciones')->with('error', 'No se pudo finalizar la votación.');
        }
    }
}
