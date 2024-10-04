<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Pastikan hanya admin yang bisa mengakses
    if (auth()->user()->role === 'admin') {
        // Ambil semua pelanggan
        $query = Customer::query(); // Asumsi Anda memiliki model Customer
         // Cek apakah ada input pencarian
         if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            // Filter pelanggan berdasarkan nama atau email
            $query->where('nama', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        // Ambil hasil pencarian atau semua pelanggan jika tidak ada pencarian
        $customers = $query->get();
        return view('customers.index', compact('customers'));
    }
    
        // Jika bukan admin, redirect ke halaman create
        return redirect()->route('customers.create');
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            'nama' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email',
            'nomor_telepon' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'paspor' => 'required|in:Sudah ada,Belum ada',
            'paspor_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ktp_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Proses upload gambar jika ada
        $pasporPath = $request->hasFile('paspor_photo') ? 
            $request->file('paspor_photo')->store('uploads/paspor_photos', 'public') : null;
    
        $ktpPath = $request->hasFile('ktp_photo') ? 
            $request->file('ktp_photo')->store('uploads/ktp_photos', 'public') : null;
    
        // Membuat customer baru
        $customer = Customer::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'paspor' => $request->paspor,
            'paspor_photo' => $pasporPath,
            'ktp_photo' => $ktpPath,
        ]);
    
        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $customer = Customer::findOrFail($id);
    return view('customers.show', compact('customer'));
}

public function edit($id)
{
    $customer = Customer::findOrFail($id);
    return view('customers.edit', compact('customer'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'nomor_telepon' => 'required|string|max:15',
        'alamat' => 'required|string',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan', // Ubah validasi di sini
        'tanggal_lahir' => 'required|date',
        'paspor' => 'required',
        'paspor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'ktp_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the customer
    $customer = Customer::findOrFail($id);

    // Update the customer's information
    $customer->nama = $request->nama;
    $customer->email = $request->email;
    $customer->nomor_telepon = $request->nomor_telepon;
    $customer->alamat = $request->alamat;
    $customer->jenis_kelamin = $request->jenis_kelamin;
    $customer->tanggal_lahir = $request->tanggal_lahir;
    $customer->paspor = $request->paspor;

    // Handle file uploads
    if ($request->hasFile('paspor_photo')) {
        $customer->paspor_photo = $request->file('paspor_photo')->store('paspor_photos', 'public');
    }
    if ($request->hasFile('ktp_photo')) {
        $customer->ktp_photo = $request->file('ktp_photo')->store('ktp_photos', 'public');
    }

    // Save the customer record
    $customer->save();

    return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
