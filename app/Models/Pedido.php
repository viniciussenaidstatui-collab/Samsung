<?php
// app/Models/Pedido.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'numero_pedido',
        'cupom_aplicado',
        'desconto_percent',
        'valor_total',
        'status',
        'endereco_entrega',
        'metodo_pagamento'
    ];

    protected $casts = [
        'desconto_percent' => 'integer',
        'valor_total' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }
}