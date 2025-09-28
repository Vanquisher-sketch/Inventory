<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tjalan extends Model
{
    use HasFactory;

    protected $table = 'tjalans';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'nomor_register',
        'konstruksi',
        'panjang',
        'lebar',
        'luas',
        'letak',
        'dokumen_tanggal',
        'dokumen_nomor',
        'status_tanah',
        'kode_tanah',
        'asal_usul',
        'harga',
        'kondisi',
        'keterangan',
    ];
}