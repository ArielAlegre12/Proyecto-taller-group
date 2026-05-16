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
        Schema::create('domesticos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreDueño');
            $table->string('nombreMascota');
            $table->string('tipoMascota');
            $table->string('motivo');
            $table->dateTime('fechaYHora');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domesticos');
    }
};
