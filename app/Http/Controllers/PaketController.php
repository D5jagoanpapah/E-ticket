<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function index(Request $request)
{
    $query = Paket::query();

    // Cek jika ada parameter pencarian
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('nama_paket', 'LIKE', "%{$search}%")
              ->orWhere('deskripsi', 'LIKE', "%{$search}%")
              ->orWhere('lokasi', 'LIKE', "%{$search}%");
    }

    $pakets = $query->get();

    return view('pakets.index', compact('pakets'));
}


    public function create()
    {
        return view('pakets.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'durasi' => 'required|integer',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'required|date',
            'ketersediaan' => 'required|integer',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:Tersedia,Penuh,Dibatalkan',
        ]);

        Paket::create($request->all());

        return redirect()->route('pakets.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('pakets.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'durasi' => 'required|integer',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'required|date',
            'ketersediaan' => 'required|integer',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:Tersedia,Penuh,Dibatalkan',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update($request->all());

        return redirect()->route('pakets.index')->with('success', 'Paket berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->route('pakets.index')->with('success', 'Paket berhasil dihapus.');
    }
}
