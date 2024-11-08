<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('folios', function (Blueprint $table) {
            $table->id('id_folio');
            $table->string('identifier', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('folios');
    }
};
