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
        $votacion = Votacion::all();
        return view('consejero.home', compact('votacion'));
    }   
    
    public function showHistorialConsejero()
    {
        return view('consejero.historial');
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
            'sigla' => 'required|string',
            'opcion_votada' => 'required|string',
        ]);
    
        // Verificar si el usuario ya ha votado en esta votación
        $hasVoted = Voto::where('run', Auth::user()->run)
                        ->where('sigla', $request->sigla)
                        ->exists();
    
        if ($hasVoted) {
            return redirect()->back()->with('error', 'Ya has votado en esta votación.');
        }
    
        // Guardar el voto en la base de datos
        Voto::create([
            'sigla' => $request->sigla,
            'run' => Auth::user()->run,  // El RUN del consejero (identificador único)
            'opcion_votada' => $request->opcion_votada,
            'carrera' => Auth::user()->carrera,  // Asumiendo que el usuario tiene una carrera asignada
            'correo' => Auth::user()->email,     // El correo del consejero
        ]);
    
    
    
        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Tu voto ha sido registrado correctamente.');
    }
    
}
