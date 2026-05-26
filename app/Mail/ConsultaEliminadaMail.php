<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Consulta;

class ConsultaEliminadaMail extends Mailable
{
    public $consulta;
    public $motivo;

    public function __construct(Consulta $consulta, $motivo){
        $this->consulta = $consulta;
        $this->motivo = $motivo;
    }

    public function build(){
        return $this->subject('Consulta Cancelada')->view('emails.consulta-eliminada');
    }
}
