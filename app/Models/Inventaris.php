<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     * Opsional jika nama tabel adalah 'inventaris' (bentuk jamak dari 'Inventaris').
     */
    protected $table = 'inventaris';

    /**
     * Kolom-kolom yang boleh diisi secara massal (mass assignable).
     * Pastikan semua nama kolom dari form Anda ada di sini.
     */
    protected $fillable = [
        'room_id',
        'nama_barang',
        'merk_model',
        'bahan',
        'tahun_pembelian',
        'kode_barang',
        'jumlah',
        'harga_beli',
        'kondisi_baik',
        'kondisi_kurang_baik',
        'kondisi_rusak_berat',
        'keterangan',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model Room.
     * Ini berarti setiap item inventaris "milik" satu ruangan.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}