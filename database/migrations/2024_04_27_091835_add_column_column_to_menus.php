<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnColumnToMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->text('gambar')->nullable()->after('nama');
            $table->text('deskripsi')->nullable()->after('gambar');
            $table->integer('harga')->nullable()->after('deskripsi');
            $table->unsignedBigInteger('tenant_id');

            $table->foreign('tenant_id')->references( 'id' )->on('tenants');
            $table->boolean('isReady')->default(1)->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            //
        });
    }
}
