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
        Schema::create('lgedungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('register');
            $table->string('kondisi');
            $table->boolean('bertingkat')->default(false);
            $table->boolean('beton')->default(false);
            $table->unsignedInteger('luas_lantai');
            $table->text('letak');
            $table->date('dokumen_tanggal')->nullable();
            $table->string('dokumen_nomor')->nullable();
            $table->unsignedInteger('luas_tanah');
            $table->string('status_tanah')->nullable();
            $table->string('kode_tanah')->nullable();
            $table->string('asal_usul');
            $table->unsignedBigInteger('harga');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lgedungs');
    }
};
