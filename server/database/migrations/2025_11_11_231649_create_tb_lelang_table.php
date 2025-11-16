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
        Schema::create('tb_lelang', function (Blueprint $table) {
            $table->id('id_lelang');
            $table->unsignedBigInteger('id_barang');
            $table->date('tgl_lelang');
            $table->integer('harga_akhir');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_petugas');
            $table->enum('status', ['dibuka', 'ditutup'])->nullable();

            $table->foreign('id_barang')->references('id_barang')->on('tb_barang');
            $table->foreign('id_user')->references('id_user')->on('tb_masyarakat');
            $table->foreign('id_petugas')->references('id_petugas')->on('tb_petugas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_lelang');
    }
};
