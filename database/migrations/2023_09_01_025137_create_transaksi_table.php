<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruangan_id')->index('ruangan_index')->nullable();
            $table->integer('total');
            $table->boolean('isAntar');
            $table->enum('metode_pembayaran', ['transfer', 'cod'])->default('transfer');
            // $table->boolean('status_pengantaran');
            // userid, ruanganId, total, status, isAntar, isTransfer
            $table->softDeletes();

            // $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
