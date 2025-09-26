<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 'inventaris' adalah nama tabelnya
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id(); // Kolom "No Urut"
            
            // Foreign key yang menghubungkan ke tabel 'rooms'
            // Jika sebuah ruangan dihapus, semua inventaris di dalamnya juga ikut terhapus (onDelete('cascade'))
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');

            $table->string('nama_barang'); // Kolom "Nama Barang / Jenis Barang"
            $table->string('merk_model')->nullable(); // Kolom "Merk / Model", boleh kosong
            $table->string('bahan')->nullable(); // Kolom "Bahan", boleh kosong
            $table->year('tahun_pembelian')->nullable(); // Kolom "Tahun Pembelian"
            $table->string('kode_barang')->unique(); // Kolom "No. Kode Barang", harus unik
            $table->unsignedInteger('jumlah')->default(0); // Kolom "Jumlah"
            $table->unsignedBigInteger('harga_beli')->default(0); // Kolom "Harga Beli (Rp)"

            // Kolom untuk "Keadaan Barang"
            $table->unsignedInteger('kondisi_baik')->default(0);
            $table->unsignedInteger('kondisi_kurang_baik')->default(0);
            $table->unsignedInteger('kondisi_rusak_berat')->default(0);

            $table->text('keterangan')->nullable(); // Kolom "Keterangan", boleh kosong
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};