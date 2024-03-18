<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnMenuToMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn(['name', 'category', 'icon']);
            $table->string('nama')->nullable();
            $table->string('kategori')->nullable();
            $table->string('ikon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->string('icon')->nullable();
            $table->dropColumn(['nama', 'kategori', 'ikon']);
        });
    }
}
