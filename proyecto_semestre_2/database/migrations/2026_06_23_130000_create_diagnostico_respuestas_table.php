<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnostico_respuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('pregunta_numero');
            $table->integer('opcion_elegida');
            $table->boolean('es_correcta');
            $table->timestamps();

            $table->unique(['user_id', 'pregunta_numero']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnostico_respuestas');
    }
};
