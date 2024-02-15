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
        Schema::create('especialidades', function (Blueprint $table) {
            $table->bigIncrements('id'); // Columna de ID autoincremental
            $table->string('nombre'); // Columna para el nombre de la especialidad
            $table->string('descripcion')->nullable(); // Columna opcional para descripción
            $table->timestamps(); // Columnas de marcas de tiempo para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); // Deshabilita restricciones de claves foráneas

        Schema::dropIfExists('especialidades'); // Elimina la tabla 'especialidades' si existe

        Schema::enableForeignKeyConstraints(); // Vuelve a habilitar restricciones de claves foráneas
    
    }
};
