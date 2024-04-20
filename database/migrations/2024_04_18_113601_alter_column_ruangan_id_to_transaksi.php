<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterColumnRuanganIdToTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE transaksi MODIFY COLUMN ruangan_id BIGINT UNSIGNED');
        // Schema::table('transaksi', function (Blueprint $table) {
        //     $table->unsignedBigInteger('ruangan_id')->nullable()->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE transaksi MODIFY ruangan_id UNSIGNED BIGINT NOT NULL');
    }
}
