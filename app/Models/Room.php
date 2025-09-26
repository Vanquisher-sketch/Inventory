<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     * Opsional jika nama tabel adalah bentuk jamak dari nama model (rooms).
     */
    protected $table = 'rooms';

    /**
     * Atribut yang boleh diisi secara massal (mass assignable).
     * DIUBAH: 'code' menjadi 'kode_ruangan' agar konsisten.
     * DIHAPUS: $guard=[] karena sudah menggunakan $fillable.
     */
    protected $fillable = [
        'name',
        'kode_ruangan',
    ];
}