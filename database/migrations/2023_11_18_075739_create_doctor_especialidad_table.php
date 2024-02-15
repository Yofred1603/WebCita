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
        // Crea la tabla "doctor_especialidad" con las columnas y restricciones necesarias
        Schema::create('doctor_especialidad', function (Blueprint $table) {


            $table->bigIncrements('id'); // Columna de ID autoincremental de tipo bigInteger

            $table->unsignedBigInteger('doctor_id'); // Columna para la clave foránea del ID del doctor
            $table->foreign('doctor_id')->references('id')->on('doctores')->onDelete('cascade');
            // Define la clave foránea 'doctor_id' que hace referencia a la tabla 'doctores' con eliminación en cascada

            $table->unsignedBigInteger('especialidad_id'); // Columna para la clave foránea del ID de la especialidad
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');
            // Define la clave foránea 'especialidad_id' que hace referencia a la tabla 'especialidades' con eliminación en cascada

            $table->timestamps(); // Columnas de marcas de tiempo para created_at y updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Deshabilita las restricciones de clave externa (foreign key constraints)
        Schema::disableForeignKeyConstraints();

        // Elimina la tabla "doctor_especialidad" si existe
        Schema::dropIfExists('doctor_especialidad');

        // Habilita nuevamente las restricciones de clave externa
        Schema::enableForeignKeyConstraints();
    }
};
