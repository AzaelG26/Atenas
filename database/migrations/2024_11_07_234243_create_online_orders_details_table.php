<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('online_orders_details', function (Blueprint $table) {
            $table->id('id_online_o_details');
            $table->unsignedBigInteger('id_online_order');
            $table->unsignedBigInteger('id_menu');
            $table->integer('quantity')->nullable(false);
            $table->text('specifications')->nullable();
            $table->unsignedBigInteger('id_folio')->nullable();

            $table->foreign('id_online_order')->references('id_online_order')->on('online_orders');
            $table->foreign('id_menu')->references('id_menu')->on('menu');
            $table->foreign('id_folio')->references('id_folio')->on('folios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_orders_details');
    }
};
