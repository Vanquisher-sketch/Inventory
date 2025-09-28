<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ltanah extends Model
{
    use HasFactory;

    protected $table = 'ltanahs';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'register',
        'luas',
        'tahun_pengadaan',
        'letak',
        'hak',
        'sertifikat_tanggal',
        'sertifikat_nomor',
        'penggunaan',
        'asal_usul',
        'harga',
        'keterangan',
    ];
}
