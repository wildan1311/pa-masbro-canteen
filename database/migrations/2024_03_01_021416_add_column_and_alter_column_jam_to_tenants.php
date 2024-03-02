<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAndAlterColumnJamToTenants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->dropColumn('jam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->timestamp('jam')->default(now());
            $table->dropColumn(['jam_buka', 'jam_tutup']);
        });
    }
}
