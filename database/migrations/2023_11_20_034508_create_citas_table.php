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
        Schema::create('citas', function (Blueprint $table) {

            $table->bigIncrements('id'); // Columna de ID autoincremental de tipo bigInteger
            $table->date('date'); // Columna para almacenar la fecha de la cita
            $table->time('time');
            $table->string('tipo');
            $table->string('descripcion');
                       
            // Columnas para las claves foráneas de 'doctor_id' y 'paciente_id'
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctores')->onDelete('cascade');

            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');

            $table->unsignedBigInteger('especialidad_id')->nullable();
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');

          


         
            $table->timestamps(); // Columnas de marcas de tiempo para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
