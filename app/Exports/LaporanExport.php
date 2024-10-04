<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    /**
     * Buat instance baru dan terima parameter filter tanggal.
     *
     * @param  string  $startDate
     * @param  string  $endDate
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Ambil koleksi data yang akan diekspor dengan filter tanggal.
     *
     * @return Collection
     */
    public function collection()
{
    // Query data with join between customers, pemesanans, pembayarans, and pakets
    return Customer::join('pemesanans', 'customers.id_customer', '=', 'pemesanans.id_customer')
        ->join('pembayarans', 'pemesanans.id_pemesanan', '=', 'pembayarans.id_pemesanan')
        ->join('pakets', 'pemesanans.id_paket', '=', 'pakets.id_paket')
        ->select(
            'customers.nama',
            'customers.nomor_telepon',
            'customers.alamat',
            'customers.jenis_kelamin',
            'pakets.nama_paket',
            'pemesanans.tanggal_pemesanan',
            'pemesanans.jumlah_peserta',
            'pembayarans.jumlah_pembayaran',
            'pembayarans.tanggal_pembayaran',
            'pembayarans.metode_pembayaran',
            'pembayarans.status_pembayaran'
        )
        // Filter based on pemesanans date
        ->whereBetween('pemesanans.tanggal_pemesanan', [$this->startDate, $this->endDate])
        ->get();
}


    /**
     * Tambahkan header kolom untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama',
            'Nomor Telepon',
            'Alamat',
            'Jenis Kelamin',
            'Nama Paket',
            'Tanggal Pemesanan',
            'Jumlah Peserta',
            'Jumlah Pembayaran',
            'Tanggal Pembayaran',
            'Metode Pembayaran',
            'Status Pembayaran',
        ];
    }
}

