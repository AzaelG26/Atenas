<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id('id_address');
            $table->foreignId('id_client')->constrained('people')->onDelete('cascade');
            $table->unsignedBigInteger('id_neighborhood'); // Definir como unsignedBigInteger
            $table->foreign('id_neighborhood')->references('id')->on('neighborhoods')->onDelete('cascade');
            $table->string('street');
            $table->string('reference')->nullable();
            $table->string('interior_number')->nullable();
            $table->string('outer_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('address');
    }
};
