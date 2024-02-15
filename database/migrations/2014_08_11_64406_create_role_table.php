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
        Schema::create('role', function (Blueprint $table) {

            $table->bigIncrements('id'); // Columna de ID autoincremental de tipo bigInteger
            $table->string('nombre'); // Columna para almacenar el nombre del rol

            $table->timestamps(); // Columnas de marcas de tiempo para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role'); // Elimina la tabla 'role'
    }
};
