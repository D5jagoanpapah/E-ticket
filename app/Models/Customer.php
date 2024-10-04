<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;
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

    public function routeNotificationForDatabase($notification)
    {
        // Here you can return the data that you want to store in the database
        return [
            'pemesanan_id' => $this->id, // Assuming you want to link the notification to the customer
            'message' => "Status pemesanan telah diperbarui.", // Custom message
        ];
    }
}
