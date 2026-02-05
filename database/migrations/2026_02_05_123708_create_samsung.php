<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('samsung', function (Blueprint $table) {
            $table->id();
            $table->text('cor');
            $table->integer('ano');
            $table->text('modelo');
            $table->text('aparelho');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('samsung');
    }
};
