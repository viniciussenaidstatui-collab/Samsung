<?php

namespace App\Jobs;

use App\Models\Usuario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\BemVindoMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Usuario $usuario; // Mudado para minúsculo

    /**
     * Create a new job instance.
     */
    public function __construct(Usuario $usuario) // Mudado para minúsculo
    {
        $this->usuario = $usuario; // Corrigido
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->usuario->email)->send(new BemVindoMail($this->usuario));
    }
}