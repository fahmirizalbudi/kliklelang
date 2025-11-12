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
        Schema::create('tb_petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->string('nama_petugas');
            $table->string('username');
            $table->string('password');
            $table->unsignedBigInteger('id_level');

            $table->foreign('id_level')->references('id_level')->on('tb_level');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_petugas');
    }
};
