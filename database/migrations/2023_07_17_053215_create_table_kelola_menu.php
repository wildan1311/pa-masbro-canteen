<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKelolaMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus_kelola', function (Blueprint $table) {
            $table->id();
            $table->integer('harga');
            $table->string('gambar');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('menu_id');
            $table->softDeletes();

            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('menu_id')->references('id')->on('list_menu');
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
        Schema::dropIfExists('table_kelola_menu');
    }
}
