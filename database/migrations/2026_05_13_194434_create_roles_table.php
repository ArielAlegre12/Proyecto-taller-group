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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); //primary key autoincremental
            $table->string('nombre')->unique(); //para evitar roles duplicados
            $table->string('descripcion')->nullable(); //campo opcional
            $table->timestamps(); //created_at y update_at(automáticos)
            $table->softDeletes(); //deleted_at - borrado lógico
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles'); //revuerte con migrate:rollback
    }
};
