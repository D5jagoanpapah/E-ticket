<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pemesanan', 'jumlah_pembayaran', 'tanggal_pembayaran', 'metode_pembayaran', 'status_pembayaran'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

        public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
