<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cgedung extends Model
{
    use HasFactory;

    /**
     * Nama tabel database yang terhubung dengan model ini.
     */
    protected $table = 'cgedungs';

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'register',
        'kondisi',
        'bertingkat',
        'beton',
        'luas_lantai',
        'letak',
        'dokumen_tanggal',
        'dokumen_nomor',
        'luas_tanah',
        'status_tanah',
        'kode_tanah',
        'asal_usul',
        'harga',
        'keterangan',
    ];
}
