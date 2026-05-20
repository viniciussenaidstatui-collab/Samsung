<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperaSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo;

    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recuperação de Senha',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.recupera_senha',
            with: ['codigo' => $this->codigo]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}