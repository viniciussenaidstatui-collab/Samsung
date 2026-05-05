<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;

class BemVindoMail extends Mailable
{
    use Queueable, SerializesModels;

    public Usuario $usuario; // Mudado para minúsculo (padrão Laravel)
  
    public function __construct(Usuario $usuario) // Mudado para minúsculo
    {
        $this->usuario = $usuario; // Corrigido espaços e case
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem Vindo Samsung - ' . $this->usuario->nome, // Corrigido: $this->usuario
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.bemvindo',
            with: [
                'usuario' => $this->usuario // Mudado para minúsculo para corresponder à view
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}