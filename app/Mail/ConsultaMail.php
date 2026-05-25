<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Consulta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $consulta;

    public function __construct(Consulta $consulta){
        $this->consulta = $consulta;
    }

    public function build(){
        return $this->subject('Nueva consulta veterinaria')->view('emails.consulta');
    }
}
