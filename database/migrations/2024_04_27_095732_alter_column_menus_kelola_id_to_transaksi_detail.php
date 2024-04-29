<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnMenusKelolaIdToTransaksiDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_detail', function (Blueprint $table) {
            $table->dropForeign(["menus_kelola_id"]);
            $table->dropColumn( 'menus_kelola_id');

            // Tambahkan kolom
            $table->unsignedBigInteger( 'menu_id' )->after('catatan')->nullable();
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_detail', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropColumn(['menu_id']);

            $table->unsignedBigInteger( 'menus_kelola_id' )->after('catatan')->nullable();
            $table->foreign('menus_kelola_id')
                ->references('id')
                ->on('menus_kelola');
        });
    }
}
