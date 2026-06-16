<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    protected $table = 'boletos';

    protected $fillable = [
        'usuario_id',
        'email',
        'valor',
        'vencimento',
        'nosso_numero',
        'codigo_barras',
        'status_email',
        'enviado_em',
        'erro_msg',
    ];

    protected $casts = [
        'vencimento'  => 'date',
        'enviado_em'  => 'datetime',
    ];

    /**
     * Relacionamento com Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}