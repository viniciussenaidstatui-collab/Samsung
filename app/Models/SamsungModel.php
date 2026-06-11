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
    'user_id',
    'preco',
    'estoque',
    'descricao',
    'imagem_url'
];

    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function hasStock(int $quantidade): bool
    {
        return $this->estoque >= $quantidade;
    }
}
