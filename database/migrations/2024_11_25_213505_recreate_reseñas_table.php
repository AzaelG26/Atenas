<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateReseñasTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('reseñas');

        Schema::create('reseñas', function (Blueprint $table) {
            $table->id();
            $table->string('contenido');
            $table->unsignedBigInteger('usuario_id')->nullable(); // Ahora es nullable
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reseñas');
    }
}
