<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ktanahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('register');
            $table->unsignedInteger('luas');
            $table->year('tahun_pengadaan');
            $table->text('letak');
            $table->string('hak')->nullable();
            $table->date('sertifikat_tanggal')->nullable();
            $table->string('sertifikat_nomor')->nullable();
            $table->string('penggunaan');
            $table->string('asal_usul');
            $table->unsignedBigInteger('harga');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ktanahs');
    }
};
