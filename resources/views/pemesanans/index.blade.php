@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pemesanan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: bold;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .table-bordered td, .table-bordered th {
            border-color: #b0b0b0;
        }
        /* Styling untuk tombol */
        .btn-primary {
            background-color: #800000;
            border-color: #660000;
        }
        .btn-primary:hover {
            background-color: #660000;
            border-color: #4d0000;
        }
        .btn-primary:focus, .btn-primary:active {
            box-shadow: none !important; 
            outline: none !important; 
            background-color: #800000 !important; 
            border-color: #660000 !important; 
        }
        .btn-danger {
            background-color: #800000;
            border-color: #660000;
        }
        .btn-danger:hover {
            background-color: #660000;
            border-color: #4d0000;
        }
        .btn-info {
            background-color: #ffc107;
            border-color: #e0a800;
        }
        .btn-info:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn {
            padding: 5px 10px; /* Kurangi padding untuk membuat tombol lebih kecil */
            font-size: 0.875rem; /* Sesuaikan ukuran teks */
        }
    </style>
</head>
<body> 
    <div class="container mt-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container">
    @if(auth()->user()->role === 'admin')
        <h1>Daftar Pemesanan</h1>
        <a href="{{ route('pemesanans.create') }}" class="btn btn-primary">Tambah Data Pemesanan</a>
        
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    <!-- Form Pencarian -->
    <div class="search-form mb-3"> <!-- Tambahkan mb-3 di sini juga -->
        <form action="{{ route('pemesanans.index') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Cari pemesanan..." aria-label="Search">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>Nama Paket</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Jumlah Peserta</th>
                        <th>Status Pemesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pemesanans as $pemesanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemesanan->customer ? $pemesanan->customer->nama : 'Customer tidak ditemukan' }}</td>
                        <td>{{ optional($pemesanan->paket)->nama_paket }}</td>
                        <td>{{ $pemesanan->tanggal_pemesanan }}</td>
                        <td>{{ $pemesanan->jumlah_peserta }}</td>
                        <td>{{ $pemesanan->status_pemesanan }}</td>
                        <td>
                            <a href="{{ route('pemesanans.show', $pemesanan->id_pemesanan) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('pemesanans.edit', $pemesanan->id_pemesanan) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pemesanans.destroy', $pemesanan->id_pemesanan) }}" method="POST" style="display:inline;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</body>
</html>
