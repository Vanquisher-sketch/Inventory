<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kjalans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('nomor_register');
            $table->string('konstruksi');
            $table->unsignedInteger('panjang')->nullable();
            $table->unsignedInteger('lebar')->nullable();
            $table->unsignedInteger('luas')->nullable();
            $table->text('letak');
            $table->date('dokumen_tanggal')->nullable();
            $table->string('dokumen_nomor')->nullable();
            $table->string('status_tanah');
            $table->string('kode_tanah')->nullable();
            $table->string('asal_usul');
            $table->unsignedBigInteger('harga');
            $table->string('kondisi');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kjalans');
    }
};
