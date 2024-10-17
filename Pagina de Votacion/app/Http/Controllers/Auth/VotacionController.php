<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Votacion;
use App\Models\Voto;


class VotacionController extends Controller
{
    // Muestra la vista de creación de votación
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

    // Guarda los datos de la votación en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'sigla' => 'required|string|max:255', // Validar SIGLA
            'tema' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'opcion1' => 'required|string|max:255',
            'opcion2' => 'required|string|max:255',
            'opcion3' => 'nullable|string|max:255',
            'opcion4' => 'nullable|string|max:255',
        ]);

        // Crear un nuevo registro en la base de datos
        Votacion::create([
            'SIGLA' => $request->input('sigla'), // Almacenar SIGLA
            'NOMBRE' => $request->input('tema'),
            'DESCRIPCION' => $request->input('descripcion'),
            'OPC_1' => $request->input('opcion1'),
            'OPC_2' => $request->input('opcion2'),
            'OPC_3' => $request->input('opcion3'), // Puede ser nulo
            'OPC_4' => $request->input('opcion4'), // Puede ser nulo
            'ESTADO' => 1, // Usar un valor numérico
        ]);
        

        // Redirigir a la vista de creación con un mensaje de éxito
        return redirect()->route('votacion.create')->with('success', 'Votación creada exitosamente');
    }

    public function finalizarVotacion($sigla)
    {
        $votacion = Votacion::where('SIGLA', $sigla)->first();

        if ($votacion) {
            $votacion->ESTADO = 0; // Cambiar el estado a finalizada
            $votacion->save();

            return redirect()->route('admin.ae-historial-votaciones')->with('success', 'La votación se ha finalizado correctamente.');
        }

        return redirect()->route('admin.ae-historial-votaciones')->with('error', 'No se pudo finalizar la votación.');
    }

}
