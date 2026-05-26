<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('email');
            $table->string('tipo_animal');
            $table->string('nombre_animal');
            $table->string('especie')->nullable();
            $table->string('tipo_campo')->nullable();
            $table->string('raza')->nullable();
            $table->string('edad')->nullable();
            $table->string('peso')->nullable();
            $table->string('tipo_consulta');
            $table->string('fecha_hora');
            $table->string('descripcion');
            $table->timestamps();
            $table->string('estado')->default('Pendiente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
