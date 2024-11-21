<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReseñasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseñas', function (Blueprint $table) {
            $table->id(); // Campo para la clave primaria
            $table->string('contenido'); // Campo para el contenido de la reseña
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // Relación con la tabla 'users'
            $table->timestamps(); // Para los campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reseñas');
    }
}
