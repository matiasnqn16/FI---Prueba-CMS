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
            $table->string('barcode')->unique();
            $table->string('plu');
            $table->string('descripcion_producto');
            $table->decimal('precio_venta_producto', 8, 2);
            $table->decimal('precio_compra_producto', 8, 2);
            $table->decimal('precio_reparto_producto', 8, 2);
            $table->integer('estado_producto');
            $table->date('fecha');
            $table->string('imagen_producto')->nullable();
            $table->integer('existencia');
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
