@extends('layout.template') <!-- Pastikan layout ini mengandung struktur HTML dasar -->
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pembayaran</title>
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
    <div class="container mt-5">
        <h1>Daftar Pembayaran</h1>
        <a href="{{ route('pembayarans.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
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
                        <th>Nama Pemesanan</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayarans as $pembayaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembayaran->pemesanan->customer ? $pembayaran->pemesanan->customer->nama : 'Customer tidak ditemukan' }}</td>
                            <td>{{ $pembayaran->jumlah_pembayaran }}</td>
                            <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                            <td>{{ $pembayaran->metode_pembayaran }}</td>
                            <td>{{ $pembayaran->status_pembayaran }}</td>
                            <td>
                                <a href="{{ route('pembayarans.show', $pembayaran->id_pembayaran) }}" class="btn btn-info">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <form action="{{ route('pembayarans.destroy', $pembayaran->id_pembayaran) }}" method="POST" style="display:inline;">
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