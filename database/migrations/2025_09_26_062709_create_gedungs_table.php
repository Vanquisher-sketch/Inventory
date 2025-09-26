<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gedungs', function (Blueprint $table) {
            $table->id(); // No. Urut
            $table->string('nama_barang'); // Jenis Barang / Nama Barang
            $table->string('kode_barang')->unique();
            $table->string('register');
            $table->string('kondisi'); // Kondisi Bangunan (B, KB, RB)
            $table->boolean('bertingkat')->default(false); // Konstruksi - Bertingkat/Tidak
            $table->boolean('beton')->default(false); // Konstruksi - Beton/Tidak
            $table->unsignedInteger('luas_lantai'); // Luas Lantai M2
            $table->text('letak'); // Letak / Alamat
            $table->date('dokumen_tanggal')->nullable(); // Dokumen - Tanggal
            $table->string('dokumen_nomor')->nullable(); // Dokumen - Nomor
            $table->unsignedInteger('luas_tanah'); // Luas M2 (Tanah)
            $table->string('status_tanah')->nullable(); // Status Tanah
            $table->string('kode_tanah')->nullable(); // Nomor Kode Tanah
            $table->string('asal_usul'); // Asal-usul
            $table->unsignedBigInteger('harga'); // Harga
            $table->text('keterangan')->nullable(); // Keterangan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gedungs');
    }
};