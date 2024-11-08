<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id_payment');
            $table->foreignId('id_payment_method')->constrained('payment_methods', 'id_payment_method')->onDelete('cascade');
            $table->integer('amount');
            $table->timestamp('payment_date')->useCurrent();
            $table->enum('status', ['Pending', 'Completed', 'Failed', 'Refunded']);
            $table->string('reference_number', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
