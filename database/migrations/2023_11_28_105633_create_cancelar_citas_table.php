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
        Schema::create('cancelar_citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('justificacion')->nullable();

            $table->unsignedBigInteger('cancelar_by')->nullable();
            $table->foreign('cancelar_by')->references('id')->on('pacientes')->onDelete('cascade');

            $table->unsignedBigInteger('cita_id')->nullable();
            $table->foreign('cita_id')->references('id')->on('citas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelar_citas');
    }
};
