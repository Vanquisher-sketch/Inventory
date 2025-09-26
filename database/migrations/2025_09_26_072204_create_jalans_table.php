<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jalans', function (Blueprint $table) {
            $table->id(); // No Urut
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('nomor_register');
            $table->string('konstruksi');
            $table->unsignedInteger('panjang')->nullable(); // Panjang (KM)
            $table->unsignedInteger('lebar')->nullable(); // Lebar (M)
            $table->unsignedInteger('luas')->nullable(); // Luas (M2)
            $table->text('letak'); // Letak / Lokasi
            $table->date('dokumen_tanggal')->nullable();
            $table->string('dokumen_nomor')->nullable();
            $table->string('status_tanah');
            $table->string('kode_tanah')->nullable();
            $table->string('asal_usul');
            $table->unsignedBigInteger('harga');
            $table->string('kondisi'); // Kondisi (B, KB, RB)
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jalans');
    }
};