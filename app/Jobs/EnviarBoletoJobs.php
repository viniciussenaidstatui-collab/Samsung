<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\BoletoMail;
use App\Models\Boleto;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EnviarBoletoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $usuario;
    public $valor;
    public $vencimento;
    public $nosso_numero;
    public $codigo_barras;
    public $boleto_id;

    public function __construct($usuario, $valor, $vencimento, $nosso_numero, $codigo_barras, $boleto_id)
    {
        $this->usuario      = $usuario;
        $this->valor        = $valor;
        $this->vencimento   = $vencimento;
        $this->nosso_numero = $nosso_numero;
        $this->codigo_barras = $codigo_barras;
        $this->boleto_id    = $boleto_id;
    }

    public function handle(): void
    {
        try {
            Mail::to($this->usuario->email)
                ->send(new BoletoMail(
                    $this->usuario,
                    $this->valor,
                    $this->vencimento,
                    $this->nosso_numero,
                    $this->codigo_barras
                ));

            // Atualiza o registro na tabela como enviado
            Boleto::where('id', $this->boleto_id)->update([
                'status_email' => 'enviado',
                'enviado_em'   => now(),
                'erro_msg'     => null,
            ]);

            Log::info('Boleto enviado com sucesso', [
                'boleto_id' => $this->boleto_id,
                'email'     => $this->usuario->email,
            ]);

        } catch (\Throwable $e) {
            // Marca como erro na tabela para facilitar reenvio
            Boleto::where('id', $this->boleto_id)->update([
                'status_email' => 'erro',
                'erro_msg'     => $e->getMessage(),
            ]);

            Log::error('Falha ao enviar boleto', [
                'boleto_id' => $this->boleto_id,
                'erro'      => $e->getMessage(),
            ]);

            // Re-lança para o Laravel tentar novamente (retries da fila)
            throw $e;
        }
    }

    /**
     * Número de tentativas antes de desistir.
     */
    public int $tries = 3;

    /**
     * Segundos de espera entre tentativas.
     */
    public int $backoff = 60;
}