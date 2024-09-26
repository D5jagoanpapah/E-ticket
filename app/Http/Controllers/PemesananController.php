<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Paket;
use App\Models\Customer;
use Illuminate\Http\Request;

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
        $pemesanans = Pemesanan::when($search, function ($query, $search) {
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
        $pemesanans = Pemesanan::all(); // Asumsi Anda memiliki model pemesanan
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
        $request->validate([
            'id_customer' => 'required|integer',
            'id_paket' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'jumlah_peserta' => 'required|integer',
            'status_pemesanan' => 'required|in:Menunggu,Dikonfirmasi',
            'catatan' => 'nullable|string',
        ]);        

        Pemesanan::create($request->all());
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan created successfully.');
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
            'status_pemesanan' => 'required|in:Menunggu,Dikonfirmasi',
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
}
