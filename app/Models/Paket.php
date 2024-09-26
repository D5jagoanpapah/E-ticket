<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $primaryKey = 'id_paket';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'durasi',
        'ketersediaan',
        'tanggal_keberangkatan',
        'tanggal_kepulangan',
        'lokasi',
        'status'
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_paket');
    }
}
