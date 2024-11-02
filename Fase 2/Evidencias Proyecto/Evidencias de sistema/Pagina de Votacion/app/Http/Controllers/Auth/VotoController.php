<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Voto;
use App\Models\Votacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotoController extends Controller
{
    public function showHomeConsejero()
    {
        $votaciones = Votacion::where('ESTADO', 1)->get();
        $votosUsuario = Voto::where('RUN', Auth::user()->run)->get();
        // Añadir información sobre si el usuario votó y la opción votada
        $votacionesConVotos = $votaciones->map(function ($votacion) use ($votosUsuario) {
            // Verificar si el usuario votó en esta votación específica
            $votoRealizado = $votosUsuario->firstWhere('SIGLA', $votacion->SIGLA);
            // Agregar la opción votada (si existe) y un indicador de voto realizado
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
        // Filtrar votaciones en las que el usuario haya participado
        $votacionesConVotos = $votaciones->filter(function ($votacion) use ($votosUsuario) {
            // Verificar si el usuario votó en esta votación específica
            return $votosUsuario->contains('SIGLA', $votacion->SIGLA);
        })->map(function ($votacion) use ($votosUsuario) {
            // Obtener el voto específico del usuario para esta votación
            $votoRealizado = $votosUsuario->firstWhere('SIGLA', $votacion->SIGLA);
            // Añadir la opción votada a la votación
            $votacion->opcion_votada = $votoRealizado->OPCION_VOTADA ?? null;
            return $votacion;
        });
        return view('consejero.historial', compact('votacionesConVotos'));
    }

    // Mostrar el formulario de votación para los consejeros
    public function showVotingForm()
    {
        // Obtener las votaciones activas
        $votaciones = Votacion::where('estado', 'activo')->get();

        // Cargar la vista para votar (ubicada en 'resources/views/consejero/votar.blade.php')
        return view('consejero.votar', compact('votaciones'));
    }

    // Guardar el voto del consejero
    public function storeVote(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'sigla' => 'required|string|max:12',
            'opcion_votada' => 'required|string|max:30',
        ]);
    
        // Verificar si el usuario ya ha votado en esta votación
        $hasVoted = Voto::where('RUN', Auth::user()->run)
                        ->where('SIGLA', $request->sigla)
                        ->exists();
    
        if ($hasVoted) {
            return redirect()->back()->with('error', 'Ya has votado en esta votación.');
        }
    
        // Crear el voto utilizando la instancia y el método `save()`
        $voto = new Voto();
        $voto->SIGLA = $request->sigla;
        $voto->RUN = Auth::user()->run;
        $voto->OPCION_VOTADA = $request->opcion_votada;
        $voto->CARRERA = Auth::user()->carrera;
        $voto->CORREO = Auth::user()->email;
        $voto->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Tu voto ha sido registrado correctamente.');
    }
    
}
