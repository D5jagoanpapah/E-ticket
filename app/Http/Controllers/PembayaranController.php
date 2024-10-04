<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayarans = Pembayaran::with('pemesanan.customer')->get();

        // Pastikan hanya admin yang bisa mengakses
    if (auth()->user()->role === 'admin') {
        // Ambil semua pelanggan
        $pembayarans = Pembayaran::all(); // Asumsi Anda memiliki model Customer
        return view('pembayarans.index', compact('pembayarans'));
    }
    
        // Jika bukan admin, redirect ke halaman create
        return redirect()->route('pembayarans.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemesanans = Pemesanan::with('customer')->get();
        return view('pembayarans.create', compact('pemesanans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pemesanan' => 'required|exists:pemesanans,id_pemesanan',
            'jumlah_pembayaran' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string|max:20',
            'status_pembayaran' => 'nullable|in:berhasil,gagal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pembayaran::create($request->all());

        return redirect()->route('pembayarans.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayarans.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        $pemesanans = Pemesanan::all();
        return view('pembayarans.edit', compact('pembayaran', 'pemesanans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validator = Validator::make($request->all(), [
            'id_pemesanan' => 'required|exists:pemesanans,id_pemesanan',
            'jumlah_pembayaran' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string|max:255',
            'status_pembayaran' => 'nullable|in:berhasil,gagal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pembayaran->update($request->all());

        return redirect()->route('pembayarans.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayarans.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function getPemesananData($id_pemesanan)
    {
        $pemesanan = Pemesanan::with('paket')->find($id_pemesanan);

        if ($pemesanan) {
            $jumlah_pembayaran = $pemesanan->paket->harga * $pemesanan->jumlah_peserta;
            return response()->json([
                'jumlah_pembayaran' => $jumlah_pembayaran
            ]);
        } else {
            return response()->json(['error' => 'Pemesanan tidak ditemukan'], 404);
        }
    }
}
