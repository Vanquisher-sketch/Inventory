<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Opsional, untuk type-hinting

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kode_ruangan',
    ];

    // === TAMBAHKAN METHOD INI ===
    /**
     * Mendefinisikan relasi "hasMany" ke model Inventaris.
     * Satu ruangan bisa memiliki banyak item inventaris.
     */
    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'room_id');
    }
}