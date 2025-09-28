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
        Schema::create('lrusaks', function (Blueprint $table) {
            $table->id();
            $table->string('no_id_pemda')->unique();
            $table->string('nama_barang');
            $table->text('spesifikasi')->nullable();
            $table->string('no_polisi')->nullable();
            $table->year('tahun_perolehan');
            $table->unsignedBigInteger('harga_perolehan');
            $table->string('kondisi');
            $table->string('tercatat_di_kib');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lrusaks');
    }
};
