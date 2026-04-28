<?php

namespace App\Jobs;

use App\Models\Usuario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use app\Mail\BemVindoMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
class EnviarEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Usuario $Usuario;

    /**
     * Create a new job instance.
     */
    

    public function __construct(Usuario $Usuario)
    {
        $this->Usuario = $Usuario;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->Usuario->email)->send(new BemVindoMail($this->Usuario));
    }
}
