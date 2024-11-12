@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Umrah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 900px;
            margin: auto;
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
        .btn-maroon {
            background-color: #800000; /* Maroon color */
            border: none;
            color: #fff; /* White text */
        }
        .btn-maroon:hover {
            background-color: #660000; /* Darker maroon */
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container form-container mt-3"> <!-- Reduced margin-top here -->
        <div class="card">
            <div class="card-header py-3">
                <h2 class="mb-0">Tambah Paket Umrah</h2>
            </div>
            <div class="card-body p-4">
            <form action="{{ route('pakets.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="nama_paket" class="form-label">Nama Paket</label>
                            <input type="text" name="nama_paket" id="nama_paket" class="form-control" placeholder="Masukkan nama paket" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi paket" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" step="0.01" placeholder="Masukkan harga" required>
                        </div>
                        <div class="col-md-4">
                            <label for="durasi" class="form-label">Durasi (Hari)</label>
                            <input type="number" name="durasi" id="durasi" class="form-control" placeholder="Durasi perjalanan" required>
                        </div>
                        <div class="col-md-4">
                            <label for="ketersediaan" class="form-label">Ketersediaan</label>
                            <input type="number" name="ketersediaan" id="ketersediaan" class="form-control" placeholder="Jumlah tersedia" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_kepulangan" class="form-label">Tanggal Kepulangan</label>
                            <input type="date" name="tanggal_kepulangan" id="tanggal_kepulangan" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi keberangkatan" required>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Penuh">Penuh</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-maroon me-2">Simpan</button>
                        <a href="{{ route('pakets.index') }}" class="btn btn-outline-secondary">Keluar</a>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
