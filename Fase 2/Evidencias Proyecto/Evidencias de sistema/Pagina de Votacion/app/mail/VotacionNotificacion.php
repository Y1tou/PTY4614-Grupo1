<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Votacion;

class VotacionNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $sigla;
    public $accion;
    public $ganador;
    public $descripcion;

    public function __construct($votacion, $accion) 
    {
        $this->sigla = $votacion;
        $this->accion = $accion;

        // Obtenemos la información de la votación dependiendo de la acción
        $votacionObj = Votacion::where('SIGLA', $votacion)->first();

        if ($accion == 'eliminar') {
            $this->ganador = $votacionObj->GANADOR;
            $this->descripcion = $votacionObj->DESCRIPCION;
        } elseif ($accion == 'crear') {
            $this->descripcion = $votacionObj->DESCRIPCION;
        }
    }

    public function build()
    {
        return $this->view('emails.emailsvotacion')
                    ->subject('Notificación de Votación')
                    ->with([
                        'sigla' => $this->sigla,
                        'accion' => $this->accion,
                        'ganador' => $this->ganador ?? null, // El ganador solo se pasa si se finaliza la votación
                        'descripcion' => $this->descripcion ?? null // La descripción se pasa si aplica
                    ]);
    }
}
