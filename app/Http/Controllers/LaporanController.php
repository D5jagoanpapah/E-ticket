<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan; 
use App\Models\Customer; 
use App\Models\Pembayaran; 
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        // Logic untuk menampilkan laporan
        return view('laporan');  // Pastikan file view 'laporan.blade.php' ada di folder 'resources/views'
    }
    /**
     * Ekspor data ke file Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil tanggal mulai dan akhir dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ekspor data dengan filter tanggal
        return Excel::download(new LaporanExport($startDate, $endDate), 'laporan.xlsx');
    }

    /**
     * Cetak laporan dengan filter tanggal.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function cetakLaporanExcel(Request $request)
    {
        // Tampilkan view form untuk cetak laporan Excel
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data berdasarkan tanggal pemesanan jika filter ada
        $data = [];

        if ($startDate && $endDate) {
            $data = Pemesanan::with(['customer', 'pembayaran'])
                ->whereBetween('tanggal_pemesanan', [$startDate, $endDate])
                ->get();
        }

        // Tampilkan view dengan data
        return view('laporan', compact('data', 'startDate', 'endDate'));
    }
}
