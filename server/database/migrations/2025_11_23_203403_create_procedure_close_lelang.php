<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS CLOSE_LELANG");
        DB::unprepared("CREATE PROCEDURE CLOSE_LELANG(IN lelangId BIGINT) BEGIN UPDATE tb_lelang SET harga_akhir = (SELECT penawaran_harga FROM history_lelang WHERE id_lelang = lelangId ORDER BY penawaran_harga DESC LIMIT 1), id_user = (SELECT id_user FROM history_lelang WHERE id_lelang = lelangId ORDER BY penawaran_harga DESC LIMIT 1), status = 'ditutup' WHERE id_lelang = lelangId; END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS CLOSE_LELANG");
    }
};
