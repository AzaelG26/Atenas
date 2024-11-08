<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('neighborhoods', function (Blueprint $table) {
            $table->id('id'); // Usa id() para la columna principal y hazla `unsignedBigInteger` para la relación
            $table->string('name', 100);
            $table->unsignedBigInteger('id_settlement_type')->nullable();
            $table->unsignedBigInteger('id_postal_codes')->nullable();

            $table->foreign('id_settlement_type')->references('id_settlement_type')->on('settlement_type')->onDelete('set null');
            $table->foreign('id_postal_codes')->references('id_postal_codes')->on('postal_codes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('neighborhoods');
    }
};
