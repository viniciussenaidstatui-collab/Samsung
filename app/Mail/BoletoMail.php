<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BoletoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $valor;
    public $vencimento;
    public $nosso_numero;
    public $codigo_barras;

    public function __construct($usuario, $valor, $vencimento, $nosso_numero, $codigo_barras)
    {
        $this->usuario = $usuario;
        $this->valor = $valor;
        $this->vencimento = $vencimento;
        $this->nosso_numero = $nosso_numero;
        $this->codigo_barras = $codigo_barras;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Boleto Gerado - Samsung',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.boleto',
            with: [
                'usuario' => $this->usuario,
                'valor' => $this->valor,
                'vencimento' => $this->vencimento,
                'nosso_numero' => $this->nosso_numero,
                'codigo_barras' => $this->codigo_barras,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}