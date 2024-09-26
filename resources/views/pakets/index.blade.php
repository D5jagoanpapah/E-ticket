@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Paket Umrah</title>
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
        <h1>Daftar Paket</h1>
        <a href="{{ route('pakets.create') }}" class="btn btn-primary">Tambah Paket</a>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-container mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Paket</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Durasi (Hari)</th>
                        <th>Ketersediaan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pakets as $paket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $paket->nama_paket }}</td>
                            <td>{{ $paket->deskripsi }}</td>
                            <td>{{ number_format($paket->harga, 2, ',', '.') }}</td>
                            <td>{{ $paket->durasi }}</td>
                            <td>{{ $paket->ketersediaan }}</td>
                            <td>{{ \Carbon\Carbon::parse($paket->tanggal_keberangkatan)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($paket->tanggal_kepulangan)->format('d-m-Y') }}</td>
                            <td>{{ $paket->lokasi }}</td>
                            <td>{{ $paket->status }}</td>
                            <td>
                                <a href="{{ route('pakets.edit', $paket->id_paket) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pakets.destroy', $paket->id_paket) }}" method="POST" style="display:inline;">
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
