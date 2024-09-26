<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_customer';
    public $incrementing = true;

    // Tentukan jenis primary key
    protected $keyType = 'int';

    // Tentukan apakah tabel menggunakan timestamps
    public $timestamps = false;

    // Tentukan atribut yang dapat diisi
    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'paspor',
        'paspor_photo',
        'ktp_photo'
    ];

    // Tentukan tipe data untuk kolom tertentu
    protected $casts = [
        'tanggal_lahir' => 'datetime',
    ];

    // Relasi dengan model Pemesanan
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_customer', 'id_customer');
    }
}
