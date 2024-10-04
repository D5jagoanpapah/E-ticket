@extends('layout.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .btn-primary {
            background-color: #800000;
            border-color: #660000;
        }
        .btn-primary:hover {
            background-color: #660000;
            border-color: #4d0000;
        }
        .btn-danger {
            background-color: #800000; /* Maroon */
            border-color: #660000;
        }
        .btn-danger:hover {
            background-color: #660000;
            border-color: #4d0000;
        }
        .btn-warning {
            background-color: #FFC107; /* Mustard */
            border-color: #E0A800;
        }
        .btn-warning:hover {
            background-color: #E0A800;
            border-color: #D39E00;
        }
        .btn-info {
            background-color: #ffc107;
            border-color: #e0a800;
        }
        .btn-info:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-small {
            padding: 5px 10px;
            font-size: 0.8rem;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Paket</h1>
        <div class="d-flex justify-content-between mb-3">
            @if (auth()->user() && auth()->user()->role == 'admin')
                <a href="{{ route('pakets.create') }}" class="btn btn-primary btn-small">Tambah Paket</a>
            @endif
            <form action="{{ route('pakets.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Paket Umrah..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
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
                        @if (auth()->user() && auth()->user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pakets as $paket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $paket->nama_paket }}</td>
                            <td>{{ $paket->deskripsi }}</td>
                            <td>{{ 'Rp. ' . number_format($paket->harga, 2, ',', '.') }}</td>
                            <td>{{ $paket->durasi }}</td>
                            <td>{{ $paket->ketersediaan }}</td>
                            <td>{{ \Carbon\Carbon::parse($paket->tanggal_keberangkatan)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($paket->tanggal_kepulangan)->format('d-m-Y') }}</td>
                            <td>{{ $paket->lokasi }}</td>
                            <td>{{ $paket->status }}</td>
                            @if (auth()->user() && auth()->user()->role == 'admin')
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('pakets.edit', $paket->id_paket) }}" class="btn btn-warning btn-small d-flex align-items-center justify-content-center" title="Edit" style="width: 32px; height: 32px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pakets.destroy', $paket->id_paket) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-small d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
