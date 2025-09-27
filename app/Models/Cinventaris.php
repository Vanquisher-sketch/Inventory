<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinventaris extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cinventaris';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'croom_id',
        'nama_barang',
        'merk_model',
        'bahan',
        'tahun_pembelian',
        'kode_barang',
        'jumlah',
        'harga_beli',
        'kondisi',
        'keterangan',
    ];

    /**
     * Get the croom that owns the cinventaris.
     */
    public function croom()
    {
        return $this->belongsTo(Croom::class);
    }
}

