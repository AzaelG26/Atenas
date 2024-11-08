<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->string('name', 40);
            $table->text('description');
            $table->integer('price');
            $table->boolean('status')->default(true);
            $table->foreignId('id_category')->nullable()->constrained('categories', 'id_category');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu');
    }
};
