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
        @if(auth()->user()->role === 'admin')
            <h1>Daftar Pemesanan</h1>
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('pemesanans.create') }}" class="btn btn-primary">Tambah Data Pemesanan</a>
                <div class="search-form mb-3">
                    <form action="{{ route('pemesanans.index') }}" method="GET" class="d-flex">
                        <input type="text" class="form-control me-2" name="search" placeholder="Cari pemesanan..." aria-label="Search">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
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
                            <th>Nama</th>
                            <th>Paket</th>
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
                            <td>
                                @if ($pemesanan->status_pemesanan === 'Menunggu')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif ($pemesanan->status_pemesanan === 'Dikonfirmasi')
                                    <span class="badge bg-success">Dikonfirmasi</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </td>
                            <td>
                            @if($pemesanan->status_pemesanan == 'Menunggu')
                                <form action="{{ route('pemesanan.updateStatus', ['id' => $pemesanan->id_pemesanan, 'status_pemesanan' => 'Dikonfirmasi']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Disetujui</button>
                                </form>
                            @elseif($pemesanan->status_pemesanan == 'Dikonfirmasi')
                                <a href="{{ route('pemesanans.show', $pemesanan->id_pemesanan) }}" class="btn btn-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('pemesanans.destroy', $pemesanan->id_pemesanan) }}" method="POST" style="display:inline;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
@endsection
