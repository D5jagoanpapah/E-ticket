<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;  
use App\Models\Paket;     

class WelcomeController extends Controller
{
    public function index()
    {
        // Total Jumlah Peserta dari pemesanan
        $total_jumlah_peserta = Pemesanan::sum('jumlah_peserta');

        // Total stok tiket
        $total_stok_tiket = Paket::sum('ketersediaan');

        // Pemesanan yang menunggu konfirmasi
        $menunggu_konfirmasi = Pemesanan::where('status_pemesanan', 'Menunggu')->count();

        // Data pendapatan untuk chart
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; // Sesuaikan bulan
        $data_pendapatan = [10000, 15000, 12000, 18000, 20000]; // Sesuaikan dengan data pendapatan

        // Pemesanan terbaru (opsional)
        $pemesanans_terbaru = Pemesanan::orderBy('tanggal_pemesanan', 'desc')->take(10)->get();

        // Passing data ke view
        return view('welcome', compact(
            'total_jumlah_peserta', 
            'total_stok_tiket', 
            'menunggu_konfirmasi', 
            'bulan', 
            'data_pendapatan', 
            'pemesanans_terbaru'
        ));
    }

    public function dashboard()
    {
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = auth()->user()->notifications;

        return view('dashboard', compact('notifikasi'));
    }
}
