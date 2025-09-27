<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kperalatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('nomor_register');
            $table->string('merk_tipe')->nullable();
            $table->string('ukuran_cc')->nullable();
            $table->string('bahan')->nullable();
            $table->year('tahun_pembelian');
            $table->string('nomor_pabrik')->nullable();
            $table->string('nomor_rangka')->nullable();
            $table->string('nomor_mesin')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->string('nomor_bpkb')->nullable();
            $table->string('asal_usul');
            $table->unsignedBigInteger('harga');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kperalatans');
    }
};
