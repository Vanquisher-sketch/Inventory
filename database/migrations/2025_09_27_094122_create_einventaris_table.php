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
        Schema::create('einventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eroom_id')->constrained('erooms')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('merk_model')->nullable();
            $table->string('bahan')->nullable();
            $table->year('tahun_pembelian')->nullable();
            $table->string('kode_barang')->unique();
            $table->unsignedInteger('jumlah')->default(0);
            $table->unsignedBigInteger('harga_beli')->default(0);
            $table->string('kondisi'); // B, KB, RB
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('einventaris');
    }
};
