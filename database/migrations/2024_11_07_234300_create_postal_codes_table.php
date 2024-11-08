<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->id('id_postal_codes');
            $table->string('postal_code', 10)->nullable(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('postal_codes');
    }
};
