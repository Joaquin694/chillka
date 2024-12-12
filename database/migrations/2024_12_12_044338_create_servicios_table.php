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
        Schema::create('servicios_basicos', function (Blueprint $table) {
            $table->id('id_servicio');
            $table->foreignId('hogar_id')->constrained('hogares', 'id_hogar')->onDelete('cascade');
            $table->boolean('agua')->default(false);
            $table->boolean('luz')->default(false);
            $table->boolean('saneamiento')->default(false);
            $table->boolean('internet')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios_basicos');
    }
};
