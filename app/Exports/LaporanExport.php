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
        // Query data dengan join antara tabel customers, pemesanans, dan pembayarans
        return Customer::join('pemesanans', 'customers.id_customer', '=', 'pemesanans.id_customer')
            ->join('pembayarans', 'pemesanans.id_pemesanan', '=', 'pembayarans.id_pemesanan')
            ->select(
                'customers.nama',
                'customers.nomor_telepon',
                'customers.jenis_kelamin',
                'customers.nomor_paspor',
                'pemesanans.id_paket',
                'pemesanans.tanggal_pemesanan',
                'pemesanans.jumlah_peserta',
                'pembayarans.jumlah_pembayaran',
                'pembayarans.tanggal_pembayaran',
                'pembayarans.metode_pembayaran',
                'pembayarans.status_pembayaran'
            )
            // Filter berdasarkan tanggal pemesanan
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
            'Jenis Kelamin',
            'Nomor Paspor',
            'ID Paket',
            'Tanggal Pemesanan',
            'Jumlah Peserta',
            'Jumlah Pembayaran',
            'Tanggal Pembayaran',
            'Metode Pembayaran',
            'Status Pembayaran',
        ];
    }
}

