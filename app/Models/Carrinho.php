<?php
// app/Models/Carrinho.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $table = 'carrinhos';

    protected $fillable = [
        'user_id',
        'session_id',
        'produto_id',
        'quantidade',
        'preco_unitario'
    ];

    protected $casts = [
        'quantidade' => 'integer',
        'preco_unitario' => 'decimal:2'
    ];

    public function produto()
    {
        return $this->belongsTo(SamsungModel::class, 'produto_id');
    }

    public function getSubtotalAttribute(): float
    {
        return $this->quantidade * $this->preco_unitario;
    }
}