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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->decimal('stock_actual', 10, 2);
            $table->string('unidad_medida',20);
            $table->date('fecha_caducidad');
            #$table->unsignedBigInteger('id_categorias'); 
            #$table->unsignedBigInteger('id_proveedores'); 
            #$table->foreignId('id_categorias')->references('id')->on('categorias');
            #$table->foreignId('id_proveedores')->references('id')->on('proveedores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
