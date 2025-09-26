<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menjalankan migrasi untuk membuat tabel.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            // Kolom Primary Key (ID) yang auto-increment
            $table->id();

            // Kolom untuk menyimpan nama ruangan, tipe data VARCHAR
            $table->string('name');

            // PERBAIKAN: Menambahkan kolom 'kode_ruangan' dan membuatnya unik
            // Ini akan mencegah ada dua ruangan dengan kode yang sama di database.
            $table->string('kode_ruangan')->unique();

            // Kolom 'created_at' dan 'updated_at' secara otomatis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Menjalankan perintah untuk menghapus tabel jika migrasi di-rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};