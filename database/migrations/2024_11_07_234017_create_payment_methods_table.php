<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id('id_payment_method');
            $table->string('method_name', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
};