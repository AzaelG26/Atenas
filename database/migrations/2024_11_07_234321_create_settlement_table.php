<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settlement_type', function (Blueprint $table) {
            $table->id('id_settlement_type');
            $table->string('settlement_type_name', 40);
        });
    }

    public function down()
    {
        Schema::dropIfExists('settlement_type');
    }
};
