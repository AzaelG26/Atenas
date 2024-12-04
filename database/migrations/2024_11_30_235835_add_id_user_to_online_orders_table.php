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
        Schema::table('online_orders', function (Blueprint $table) { {
                Schema::table('online_orders', function (Blueprint $table) {
                    $table->unsignedBigInteger('id_user')->nullable();
                });
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
        Schema::table('online_orders', function (Blueprint $table) {
            $table->dropColumn('id_user');
        });
    }
};
