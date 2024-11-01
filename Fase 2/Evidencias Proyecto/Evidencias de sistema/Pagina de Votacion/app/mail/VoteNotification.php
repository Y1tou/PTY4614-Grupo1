<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VoteNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sigla;
    public $opcion_votada;

    public function __construct($sigla, $opcion_votada)
    {
        $this->sigla = $sigla;
        $this->opcion_votada = $opcion_votada;
    }

    public function build()
    {
        return $this
            ->subject('Notificación de Voto')
            ->view('emails.vote_notification');
    }
}
