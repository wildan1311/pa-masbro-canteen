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
            CREATE OR REPLACE FUNCTION tr_Pembayaran_Masbro()
            RETURNS TRIGGER AS $$
            BEGIN
                IF NEW."isAntar" = 1 THEN
                    INSERT INTO pembayaran_masbro (total, created_at)
                    VALUES (NEW."ongkos_kirim", NOW());
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE OR REPLACE TRIGGER tr_Pembayaran_Masbro AFTER INSERT ON transaksi
            FOR EACH ROW EXECUTE FUNCTION tr_Pembayaran_Masbro();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
        DROP TRIGGER IF EXISTS tr_Pembayaran_Masbro ON transaksi;
        DROP FUNCTION IF EXISTS tr_Pembayaran_Masbro();
        ');
    }
}
