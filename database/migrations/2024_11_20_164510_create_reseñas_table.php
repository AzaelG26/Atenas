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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('review'); // Mantener uno de los campos `review`.
            $table->unsignedBigInteger('usuario_id')->nullable(); // Ahora es nullable
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('satisfaction_level') // Nuevo campo para nivel de satisfacción.
                ->unsigned()
                ->checkBetween(1, 5); // Agregar restricción para valores entre 1 y 5.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
