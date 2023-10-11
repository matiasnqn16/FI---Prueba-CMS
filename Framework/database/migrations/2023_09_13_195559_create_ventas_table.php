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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('forma_pago_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('codigo_ticket')->unique();
            $table->decimal('total', 8, 2);
            $table->date('fecha');
            $table->integer('estado');
            $table->integer('tipo_venta');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('forma_pago_id')->references('id')->on('forma_pagos');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
