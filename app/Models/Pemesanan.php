<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanans';
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'id_customer',
        'id_paket',
        'tanggal_pemesanan',
        'jumlah_peserta',
        'status_pemesanan',
        'catatan',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }

    public function pembayarans()
    {
        return $this->hasMany(Transaksi::class, 'id_pemesanan', 'id_pemesanan');
    }
    public function pembayaran()
    {
        // Pastikan nama foreign key 'id_pemesanan' sesuai dengan kolom foreign key di tabel pembayaran
        return $this->hasOne(Pembayaran::class, 'id_pemesanan', 'id_pemesanan');
    }
        public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_customer');
    }
    public function hitungJumlahBayar()
    {
        $paket = $this->paket; // Ambil paket yang berhubungan dengan pemesanan ini
        if ($paket) {
            return $paket->harga * $this->jumlah_tiket; // Hitung total bayar
        }
        return 0; // Jika paket tidak ditemukan, kembalikan 0
    }
}
