<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesTable extends Migration
{
    public function up()
    {
        // Migración de la tabla `imagenes`
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->foreignId('menu_id')->constrained('menu', 'id_menu')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('imagenes');
    }
}