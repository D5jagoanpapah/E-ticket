@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Umrah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 1000px; /* Increased width */
            margin: 20px auto; /* Adjusted margin for vertical positioning */
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #800000; /* Maroon color */
            color: #fff;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
    </style>
</head>
<body>

    <div class="container mt-3 form-container"> <!-- Adjusted margin -->
        <div class="card">
            <div class="card-header py-3">
                <h2 class="mb-0">Edit Paket Umrah</h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('pakets.update', $paket->id_paket) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put" />

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama_paket" class="form-label">Nama Paket</label>
                            <input type="text" name="nama_paket" id="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" step="0.01" value="{{ $paket->harga }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ $paket->deskripsi }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="durasi" class="form-label">Durasi (Hari)</label>
                            <input type="number" name="durasi" id="durasi" class="form-control" value="{{ $paket->durasi }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ketersediaan" class="form-label">Ketersediaan</label>
                            <input type="number" name="ketersediaan" id="ketersediaan" class="form-control" value="{{ $paket->ketersediaan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $paket->lokasi }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan" class="form-control" value="{{ \Carbon\Carbon::parse($paket->tanggal_keberangkatan)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_kepulangan" class="form-label">Tanggal Kepulangan</label>
                            <input type="date" name="tanggal_kepulangan" id="tanggal_kepulangan" class="form-control" value="{{ \Carbon\Carbon::parse($paket->tanggal_kepulangan)->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="Tersedia" {{ $paket->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Penuh" {{ $paket->status == 'Penuh' ? 'selected' : '' }}>Penuh</option>
                            <option value="Dibatalkan" {{ $paket->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Keluar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
