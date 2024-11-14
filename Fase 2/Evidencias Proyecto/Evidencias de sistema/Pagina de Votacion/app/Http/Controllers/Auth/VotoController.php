<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Voto;
use App\Models\Votacion;
use App\Mail\VotoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VotoController extends Controller
{
    public function redirectHome(){
        return redirect()->route('consejero.home');
    }

    public function showHomeConsejero()
    {
        $votaciones = Votacion::where('ESTADO', 1)->get();
        $votosUsuario = Voto::where('RUN', Auth::user()->run)->get();
        
        $votacionesConVotos = $votaciones->map(function ($votacion) use ($votosUsuario) {
            $votoRealizado = $votosUsuario->firstWhere('SIGLA', $votacion->SIGLA);
            $votacion->voto_realizado = $votoRealizado ? true : false;
            $votacion->opcion_votada = $votoRealizado->OPCION_VOTADA ?? null;
            return $votacion;
        });
        
        return view('consejero.home', compact('votacionesConVotos'));
    }
    
    public function showHistorialConsejero()
    {
        $votaciones = Votacion::where('ESTADO', 0)->get();
        $votosUsuario = Voto::where('RUN', Auth::user()->run)->get();

        $votacionesConVotos = $votaciones->filter(function ($votacion) use ($votosUsuario) {
            return $votosUsuario->contains('SIGLA', $votacion->SIGLA);
        })->map(function ($votacion) use ($votosUsuario) {
            $votoRealizado = $votosUsuario->firstWhere('SIGLA', $votacion->SIGLA);
            $votacion->opcion_votada = $votoRealizado->OPCION_VOTADA ?? null;
            return $votacion;
        });

        return view('consejero.historial', compact('votacionesConVotos'));
    }

    public function showVotingForm()
    {
        $votaciones = Votacion::where('estado', 'activo')->get();
        return view('consejero.votar', compact('votaciones'));
    }

    public function storeVote(Request $request)
    {
        try{
            $request->validate([
                'sigla' => 'required|string|max:12',
                'opcion_votada' => 'required|string|max:30',
            ]);

            $votoExistOption = Votacion::where('SIGLA', $request->sigla)
                ->where(function($query) use ($request){
                    $query->where('OPC_1', $request->opcion_votada)
                        ->orWhere('OPC_2', $request->opcion_votada)
                        ->orWhere('OPC_3', $request->opcion_votada)
                        ->orWhere('OPC_4', $request->opcion_votada);
                })
                ->exists();

            if ($votoExistOption) {
                $hasVoted = Voto::where('RUN', Auth::user()->run)
                                ->where('SIGLA', $request->sigla)
                                ->exists();

                if ($hasVoted) {
                    return redirect()->back()->with('error', 'Ya has votado en esta votación.');
                }

                $voto = new Voto();
                $voto->SIGLA = $request->sigla;
                $voto->RUN = Auth::user()->run;
                $voto->OPCION_VOTADA = $request->opcion_votada;
                $voto->CARRERA = Auth::user()->carrera;
                $voto->CORREO = Auth::user()->email;
                $voto->save();

                // Obtener los detalles de la votación para incluir en el correo
                $votacion = Votacion::where('SIGLA', $request->sigla)->first();
                $nombreVotacion = $votacion ? $votacion->NOMBRE : 'Votación desconocida';

                // Enviar la notificación al usuario
                Mail::to(Auth::user()->email)->send(new VotoNotification($request->sigla, $request->opcion_votada, $nombreVotacion));

                return redirect()->back()->with('success', 'Tu voto ha sido registrado correctamente.');
            }
            else{
                return redirect()->back()->with('noValido', 'Tu voto NO es valido.');
            }
        }
        catch (\Exception $e) {
            // Atrapar cualquier error y redirigir con un mensaje de error
            return redirect()->back()->with('error', 'Ocurrió un problema al enviar el voto. Por favor, inténtalo de nuevo.');
        }
    }
}
