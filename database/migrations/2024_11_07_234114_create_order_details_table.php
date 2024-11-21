<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('id_order_detail');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_menu');
            $table->integer('quantity')->nullable(false);
            $table->text('notes')->nullable();
            $table->text('specifications')->nullable();
            $table->timestamp('created_at')->nullable(false)->useCurrent(); 
            $table->timestamp('delivered_at')->nullable(); 

            $table->foreign('id_order')->references('id_order')->on('orders');
            $table->foreign('id_menu')->references('id_menu')->on('menu');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
