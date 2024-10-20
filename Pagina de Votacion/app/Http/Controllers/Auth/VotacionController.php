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
        $request->validate([
            'sigla' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'opcion1' => 'required|string|max:255',
            'opcion2' => 'required|string|max:255',
            'opcion3' => 'nullable|string|max:255',
            'opcion4' => 'nullable|string|max:255',
        ]);

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

        // Obtener correos de usuarios con TIPO = 2
        $usuarios = DB::table('admin')->where('TIPO', 2)->pluck('CORREO');

        // Enviar el correo a todos los administradores con TIPO = 2
        foreach ($usuarios as $correo) {
            Mail::to($correo)->send(new VotacionNotificacion($votacion));
        }

        return redirect()->route('votacion.create')->with('success', 'Votación creada exitosamente y correos enviados.');
    }

    public function finalizarVotacion($sigla)
    {
        $votacion = Votacion::where('SIGLA', $sigla)->first();

        if ($votacion) {
            $votacion->ESTADO = 0; // Cambiar el estado a finalizada
            $votacion->save();

            // Obtener correos de usuarios con TIPO = 2
            $usuarios = DB::table('admin')->where('TIPO', 2)->pluck('CORREO');

            // Enviar el correo a todos los administradores con TIPO = 2
            foreach ($usuarios as $correo) {
                Mail::to($correo)->send(new VotacionNotificacion($votacion));
            }

            return redirect()->route('admin.ae-historial-votaciones')->with('success', 'La votación se ha finalizado correctamente y correos enviados.');
        }

        return redirect()->route('admin.ae-historial-votaciones')->with('error', 'No se pudo finalizar la votación.');
    }
}
