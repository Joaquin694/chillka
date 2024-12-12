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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->integer('edad');
            $table->foreignId('hogar_id')->constrained('hogares', 'id_hogar')->onDelete('cascade');
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('numero_eni', 15);
            $table->enum('sexo', ['M', 'F']);
            $table->enum('estado_civil', ['soltero', 'casado', 'otro']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
