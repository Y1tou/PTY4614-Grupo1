<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VotoNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sigla;
    public $opcion_votada;
    public $nombreVotacion;

    public function __construct($sigla, $opcion_votada, $nombreVotacion)
    {
        $this->sigla = $sigla;
        $this->opcion_votada = $opcion_votada;
        $this->nombreVotacion = $nombreVotacion;
    }

    public function build()
    {
        return $this
            ->from('votacionduoc@gmail.com')
            ->subject('Notificación de Voto Realizado')
            ->view('emails.voto_notification');
    }
}
