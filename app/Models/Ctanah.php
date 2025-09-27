<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctanah extends Model
{
    use HasFactory;

    protected $table = 'ctanahs';

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
