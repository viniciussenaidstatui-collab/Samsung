<?php
// database/migrations/2026_01_15_000003_create_pedidos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('usuario')->onDelete('cascade');
            $table->string('numero_pedido')->unique();
            $table->string('cupom_aplicado')->nullable();
            $table->integer('desconto_percent')->default(0);
            $table->decimal('valor_total', 10, 2);
            $table->enum('status', ['pendente', 'pago', 'enviado', 'entregue', 'cancelado'])->default('pendente');
            $table->text('endereco_entrega')->nullable();
            $table->string('metodo_pagamento')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};