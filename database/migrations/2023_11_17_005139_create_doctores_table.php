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
        Schema::create('doctores', function (Blueprint $table) {
            $table->bigIncrements('id'); // Columna de ID autoincremental de tipo bigInteger
            $table->string('dni'); // Columna para el número de identificación del doctor
            $table->string('nombre'); // Columna para el nombre del doctor
            $table->string('apellido'); // Columna para el apellido del doctor
            $table->string('correo'); // Columna para el correo electrónico del doctor
            $table->string('direccion'); // Columna para la dirección del doctor
            $table->string('colegiatura'); // Columna para la colegiatura del doctor
            $table->string('telefono'); // Columna para el número de teléfono del doctor

            $table->unsignedBigInteger('users_id')->nullable(); // Columna para la clave foránea del usuario (puede ser nulo)
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            // Define la clave foránea 'users_id' que hace referencia a la tabla 'users' con eliminación en cascada

            $table->timestamps(); // Columnas de marcas de tiempo para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        // Se podría agregar lógica para eliminar filas relacionadas en otras tablas si es necesario
    
        Schema::dropIfExists('doctores'); // Elimina la tabla 'doctores'
    
        Schema::enableForeignKeyConstraints(); // Habilita las restricciones de clave foránea
    
    }
};
