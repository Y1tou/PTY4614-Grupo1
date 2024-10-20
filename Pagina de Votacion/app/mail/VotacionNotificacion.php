<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VotacionNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $sigla;
    public $accion; // Nueva propiedad para la acción

    public function __construct($votacion, $accion) // Agrega el nuevo parámetro
    {
        $this->sigla = $votacion->SIGLA;
        $this->accion = $accion; // Asigna la acción
    }

    public function build()
    {
        return $this->view('emails.emailsvotacion')
                    ->subject('Notificación de Votación')
                    ->with(['sigla' => $this->sigla, 'accion' => $this->accion]);
    }
}
