<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TurnoReprogramadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $turno;

    public function __construct($turno){
        $this->turno = $turno;
    }

    public function build(){
        return $this->subject('Tu turno fue reprogramado')->view('emails.turno-reprogramado');
    }
}
