<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('id_employee');
            $table->foreignId('id_people')->constrained('people')->onDelete('cascade');
            $table->boolean('admin')->default(false);
            $table->string('curp', 18);
            $table->string('nss', 11);
            $table->string('rfc', 13);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
