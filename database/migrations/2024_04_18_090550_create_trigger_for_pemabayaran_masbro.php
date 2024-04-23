<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerForPemabayaranMasbro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER tr_Pembayaran_Masbro
            AFTER INSERT ON transaksi
            FOR EACH ROW
            BEGIN
                IF NEW.isAntar = 1 THEN
                    INSERT INTO pembayaran_masbro (total, created_at, updated_at)
                    VALUES (NEW.ongkos_kirim, NOW(), NULL);
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_Pembayaran_Masbro`');
    }
}
