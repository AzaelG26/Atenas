<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Agregar columna `user_id` después de `id_order`
            $table->unsignedBigInteger('user_id')->after('id_order'); 

            // Establecer la relación de clave foránea con la tabla `users`
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Eliminar la relación de clave foránea y la columna `user_id`
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
