<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lperalatan extends Model
{
    use HasFactory;

    protected $table = 'lperalatans';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'nomor_register',
        'merk_tipe',
        'ukuran_cc',
        'bahan',
        'tahun_pembelian',
        'nomor_pabrik',
        'nomor_rangka',
        'nomor_mesin',
        'nomor_polisi',
        'nomor_bpkb',
        'asal_usul',
        'harga',
        'keterangan',
    ];
}
