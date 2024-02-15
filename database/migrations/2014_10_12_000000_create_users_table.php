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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // Columna de ID autoincremental de tipo bigInteger
            $table->string('name'); // Columna para el nombre del usuario
            $table->string('email')->unique(); // Columna para el correo electrónico único del usuario
            $table->timestamp('email_verified_at')->nullable(); // Columna para la marca de tiempo de verificación de correo electrónico (puede ser nulo)
            $table->string('password'); // Columna para la contraseña del usuario

            $table->rememberToken(); // Columna para almacenar el token de recordar sesión

            $table->unsignedBigInteger('role_id')->nullable(); // Columna para la clave foránea del rol (puede ser nulo)
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            // Define la clave foránea 'role_id' que hace referencia a la tabla 'role' con eliminación en cascada

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

        Schema::dropIfExists('users'); // Elimina la tabla 'users'

        Schema::enableForeignKeyConstraints(); // Habilita las restricciones de clave foránea
    }
};
