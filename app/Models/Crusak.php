<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crusak extends Model
{
    use HasFactory;

    protected $table = 'crusaks';

    protected $fillable = [
        'no_id_pemda',
        'nama_barang',
        'spesifikasi',
        'no_polisi',
        'tahun_perolehan',
        'harga_perolehan',
        'kondisi',
        'tercatat_di_kib',
        'keterangan',
    ];
}
