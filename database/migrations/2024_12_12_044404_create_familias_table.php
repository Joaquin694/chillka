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
        Schema::create('familiares', function (Blueprint $table) {
            $table->id('id_familiar');
            $table->foreignId('usuario_id')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->boolean('vive_con_usuario')->default(false);
            $table->foreignId('ciudad_id')->nullable()->constrained('ciudades', 'id_ciudad')->onDelete('set null');
            $table->enum('tipo_familiar', ['padre', 'madre', 'hijo', 'hermano']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('familias');
    }
};
