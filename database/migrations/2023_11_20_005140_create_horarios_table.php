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
        Schema::create('horarios', function (Blueprint $table) {
            $table->bigIncrements('id'); // Columna de ID autoincremental de tipo bigInteger
            $table->unsignedSmallInteger('day'); // Columna para almacenar el día de la semana
            $table->boolean('activo'); // Columna booleana para indicar si el horario está activo
            $table->time('morning_start'); // Columnas para el inicio de la mañana
            $table->time('morning_end'); // Columnas para el fin de la mañana
            $table->time('afternoon_start'); // Columnas para el inicio de la tarde
            $table->time('afternoon_end'); // Columnas para el fin de la tarde
        
            // Columna de la clave foránea 'doctor_id' que puede ser nula y se eliminará en cascada
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctores')->onDelete('cascade');
           
            $table->timestamps(); // Columnas de marcas de tiempo para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('horarios');

        Schema::enableForeignKeyConstraints();
    }
};
