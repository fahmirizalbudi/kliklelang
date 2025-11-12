<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_lelang', function (Blueprint $table) {
            $table->id('id_history');
            $table->unsignedBigInteger('id_lelang');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_user');
            $table->integer('penawaran_harga');

            $table->foreign('id_lelang')->references('id_lelang')->on('tb_lelang');
            $table->foreign('id_barang')->references('id_barang')->on('tb_barang');
            $table->foreign('id_user')->references('id_user')->on('tb_masyarakat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_lelang');
    }
};
