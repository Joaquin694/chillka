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
        Schema::create('datos_adicionales', function (Blueprint $table) {
            $table->id('id_dato');
            $table->foreignId('usuario_id')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->string('clave', 50);
            $table->string('valor', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_adicionales');
    }
};
