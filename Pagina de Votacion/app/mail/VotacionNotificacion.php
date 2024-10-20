<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VotacionNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $sigla;

    public function __construct($votacion)
    {
        $this->sigla = $votacion->SIGLA; // Asignar solo la sigla
    }

    public function build()
    {
        return $this->view('emails.emailsvotacion') // Especifica la ruta correcta
                    ->subject('Notificación de Votación')
                    ->with(['sigla' => $this->sigla]); // Asegúrate de que estás pasando la información necesaria
    }
    
}
