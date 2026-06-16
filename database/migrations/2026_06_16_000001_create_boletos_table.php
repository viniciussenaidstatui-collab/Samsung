<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('email');
            $table->decimal('valor', 10, 2);
            $table->date('vencimento');
            $table->string('nosso_numero');
            $table->string('codigo_barras');
            // Status do envio: pendente | enviado | erro
            $table->enum('status_email', ['pendente', 'enviado', 'erro'])->default('pendente');
            $table->timestamp('enviado_em')->nullable();
            $table->text('erro_msg')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};
