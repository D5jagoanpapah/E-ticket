<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Paket;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\PemesananUpdated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil parameter pencarian
        $search = $request->input('search');
    
        // Query pemesanan dengan pencarian, jika ada input pencarian
        $pemesanans = Pemesanan::when($search, function ($query) use ($search) {
            // Sesuaikan kolom yang ingin dicari, misalnya nama customer atau paket
            return $query->whereHas('customer', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            })
            ->orWhereHas('paket', function ($q) use ($search) {
                $q->where('nama_paket', 'like', '%' . $search . '%');
            });
        })->get();

    
        // Pastikan hanya admin yang bisa mengakses
    if (auth()->user()->role === 'admin') {
        // Ambil semua pemesanan
        $query = Pemesanan::query();// Asumsi Anda memiliki model pemesanan
        return view('pemesanans.index', compact('pemesanans'));
    }
    
        // Jika bukan admin, redirect ke halaman create
        return redirect()->route('pemesanans.create');
    }    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengambil semua paket dari database untuk ditampilkan di form
        $customers = Customer::all();
        $pakets = Paket::all();
        return view('pemesanans.create', compact('customers', 'pakets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi dan simpan pemesanan seperti biasa
        $request->validate([
            'id_customer' => 'required|integer',
            'id_paket' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'jumlah_peserta' => 'required|integer',
            'status_pemesanan' => 'nullable|in:Menunggu,Dikonfirmasi',
            'catatan' => 'nullable|string',
        ]);
    
        // Membuat pemesanan baru dengan data yang sudah divalidasi
        $pemesanan = Pemesanan::create($request->all());
    
        // Kurangi ketersediaan paket
        $paket = Paket::find($request->id_paket);
        if ($paket && $paket->ketersediaan >= $request->jumlah_peserta) {
            $paket->ketersediaan -= $request->jumlah_peserta;
            $paket->save();
        } else {
            return redirect()->back()->withErrors(['ketersediaan' => 'Ketersediaan paket tidak mencukupi']);
        }
    
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dibuat.');
    }    

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::find($id);
    
        // Jika $pemesanan tidak ditemukan, bisa kembalikan error atau redirect
        if (!$pemesanan) {
            return redirect()->route('pemesanans.index')->withErrors('Pemesanan tidak ditemukan.');
        }
    
        return view('pemesanans.show', compact('pemesanan'));
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $customers = Customer::all();
        $pakets = Paket::all();
        return view('pemesanans.edit', compact('pemesanan', 'customers', 'pakets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $request->validate([
            'id_customer' => 'required|integer',
            'id_paket' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'jumlah_peserta' => 'required|integer',
            'status_pemesanan' => 'nullable|in:Menunggu,Dikonfirmasi',
            'catatan' => 'nullable|string',
        ]);        

        $pemesanan->update($request->all());
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan deleted successfully.');
    }

    public function updateStatus($id, Request $request)
    {
        $pemesanan = Pemesanan::with('customer')->find($id);
    
        if (!$pemesanan) {
            return redirect()->route('pemesanans.index')->withErrors('Pemesanan tidak ditemukan.');
        }
    
        // Validasi untuk memastikan bahwa status_pemesanan terkirim
        $request->validate([
            'status_pemesanan' => 'required|string',
        ]);
    
        // Mengupdate status pemesanan
        $pemesanan->status_pemesanan = $request->input('status_pemesanan');
        $pemesanan->save();
    
        // Mengambil customer yang terkait dengan pemesanan
        $customer = $pemesanan->customer;
    
        // Memastikan customer ditemukan dan bukan array
        if ($customer instanceof Customer) {
            // Mengirim notifikasi
            Notification::send($customer, new PemesananUpdated($pemesanan));
        } else {
            return redirect()->route('pemesanans.index')->withErrors('Customer tidak ditemukan untuk pemesanan ini.');
        }
    
        return redirect()->route('pemesanans.index')->with('success', 'Status pemesanan berhasil diperbarui.');
    }    
}
