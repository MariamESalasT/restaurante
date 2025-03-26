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
    Schema::create('movimientos', function (Blueprint $table) {
        $table->id();
        $table->string('tipo', 50);
        $table->decimal('cantidad', 10, 2);
        $table->date('fecha');
        $table->bigInteger('id_usuarios');
        $table->bigInteger('id_productos');
        
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
