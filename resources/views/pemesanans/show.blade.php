@extends('layout.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-maroon {
            background-color: #800000;
            color: white;
        }
        .btn-maroon:hover {
            background-color: #600000;
        }
        .card-header {
            background-color: #800000;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Detail Pemesanan</h1>
        <div class="card">
            <div class="card-header">
                Pemesanan ID: {{ $pemesanan->id_pemesanan }}
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama Pemesan:</strong> {{ $pemesanan->customer ? $pemesanan->customer->nama : 'Customer tidak ditemukan' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Paket:</strong> {{ optional($pemesanan->paket)->nama_paket ?? 'Paket tidak tersedia' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tanggal Pemesanan:</strong> {{ $pemesanan->tanggal_pemesanan }}
                    </div>
                    <div class="col-md-6">
                        <strong>Jumlah Peserta:</strong> {{ $pemesanan->jumlah_peserta }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Status Pemesanan:</strong> {{ $pemesanan->status_pemesanan }}
                    </div>
                    <div class="col-md-6">
                        <strong>Catatan:</strong> {{ $pemesanan->catatan ?? 'Tidak ada catatan' }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('pemesanans.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('pemesanans.edit', $pemesanan->id_pemesanan) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('pemesanans.destroy', $pemesanan->id_pemesanan) }}" method="POST" style="display:inline;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
