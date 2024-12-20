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
        Schema::table('online_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('id_address')->nullable()->after('id_folio'); // Campo nullable
            $table->foreign('id_address')->references('id_address')->on('address')->onDelete('set null');
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
            $table->dropForeign(['id_address']);
            $table->dropColumn('id_address');
        });
    }
};
