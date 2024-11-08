<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->string('diner_name', 100);
            $table->integer('total_price')->nullable(false);
            $table->enum('status', ['Pending', 'In Process', 'Completed', 'Delivered', 'Paid'])->nullable(false);
            $table->unsignedBigInteger('id_employee')->nullable();
            $table->unsignedBigInteger('id_payment')->nullable();
            $table->unsignedBigInteger('id_folio')->nullable();
            $table->timestamps();

            $table->foreign('id_employee')->references('id_employee')->on('employees');
            $table->foreign('id_payment')->references('id_payment')->on('payments');
            $table->foreign('id_folio')->references('id_folio')->on('folios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
