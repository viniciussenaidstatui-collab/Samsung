<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SamsungModel extends Model
{
    protected $table = 'samsung';

    protected $fillable = [
        'cor',
        'ano',
        'modelo',
        'aparelho',
           'user_id' // ADICIONE ISSO
    ];

    // Relacionamento com Usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}

