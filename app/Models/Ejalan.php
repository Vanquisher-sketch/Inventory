<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejalan extends Model
{
    use HasFactory;

    protected $table = 'ejalans';

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
