<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraRealizadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;

    public function __construct(Venta $venta){
        $this->venta = $venta;
    }

    public function build(){
        $pdf = Pdf::loadView('emails.compra-realizada', ['venta' => $this->venta]);
        return $this->subject('Factura de tu compra')->view('emails.compra-realizada')
                ->attachData($pdf->output(), 'Factura-' . $this->venta->id . '.pdf', ['mime' => 'application/pdf', ]);
    }
}
