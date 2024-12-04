<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            // Verifica si la columna 'phone' no existe antes de agregarla
            if (!Schema::hasColumn('support_tickets', 'phone')) {
                $table->string('phone')->nullable();
            }
            
            // Verifica si la columna 'email' no existe antes de agregarla
            if (!Schema::hasColumn('support_tickets', 'email')) {
                $table->string('email')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
           
           
    
    }
};
