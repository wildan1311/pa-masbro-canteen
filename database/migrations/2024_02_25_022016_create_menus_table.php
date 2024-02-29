<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url_aplikasi')->nullable();
            $table->string('url_server')->nullable();
            $table->string('category')->nullable();
            $table->string('icon')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(1);
            $table->foreignId('main_menu_id')->nullable()->constrained('menu');
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
        Schema::dropIfExists('menu');
    }
}
