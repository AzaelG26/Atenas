<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('online_orders', function (Blueprint $table) {
            $table->id('id_online_order');
            $table->string('order_name');
            $table->text('notes')->nullable();
            $table->foreignId('id_people')->constrained('people')->onDelete('cascade');
            $table->unsignedBigInteger('total_price');
            $table->unsignedBigInteger('id_payment');
            $table->foreign('id_payment')->references('id_payment')->on('payments')->onDelete('cascade');
            $table->enum('status', ['Pending', 'Canceled', 'In Process', 'Completed', 'Paid', 'Delivered'])->nullable(false);
            $table->unsignedBigInteger('id_folio')->nullable();
            $table->foreign('id_folio')->references('id_folio')->on('folios');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_orders');
    }
};
