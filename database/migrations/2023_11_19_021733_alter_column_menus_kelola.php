<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnMenusKelola extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_detail', function(Blueprint $table){
            $table->dropForeign(['menu_id']);
            $table->foreign('menu_id')->references('id')->on('menus_kelola');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_detail', function(Blueprint $table){
            $table->dropForeign(['menu_id']);
            $table->foreign('menu_id')->references('id')->on('menus_kelola');
        });
    }
}
