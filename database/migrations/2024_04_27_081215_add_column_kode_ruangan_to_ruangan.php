<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKodeRuanganToRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->string( 'kode_ruangan' )->nullable()->after( 'nama' );
            $table->decimal('lat', 10, 8)->nullable()->after('kode_ruangan');
            $table->decimal('lng', 11, 8)->nullable()->after('lat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->dropColumn(['kode_ruangan', 'lat', 'lng']);
        });
    }
}
