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
        Schema::create('factura', function (Blueprint $table) {

            $table->bigIncrements('id');
            
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->string('estado');
            $table->decimal('igv', 8, 2);
            $table->decimal('total', 10, 2);
            $table->text('descripcion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
       
        Schema::dropIfExists('factura');

        Schema::enableForeignKeyConstraints();
    }
};
