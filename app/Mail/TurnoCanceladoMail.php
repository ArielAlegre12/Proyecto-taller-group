<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TurnoCanceladoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $turno;
    public $motivo;

    public function __construct($turno, $motivo){
        $this->turno = $turno;
        $this->turno = $motivo;
    }

    public function build(){
        return $this->subject('Turno cancelado')->view('emails.turno-cancelado');
    }
}
