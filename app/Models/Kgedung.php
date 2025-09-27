<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kgedung extends Model
{
    use HasFactory;

    protected $table = 'kgedungs';

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
