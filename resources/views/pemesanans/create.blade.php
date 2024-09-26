@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-maroon {
            background-color: #800000; /* Warna maroon */
            color: white; /* Warna teks putih */
        }
        .btn-maroon:hover {
            background-color: #600000; /* Warna maroon lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Pemesanan</h1>
        <form action="{{ route('pemesanans.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_customer" class="form-label">ID Customer</label>
                    <input type="text" class="form-control" id="id_customer" name="id_customer" value="{{ old('id_customer') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_paket" class="form-label">Paket</label>
                    <select class="form-control" id="id_paket" name="id_paket" required>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id_paket }}">{{ $paket->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                    <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                    <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status_pemesanan" class="form-label">Status Pemesanan</label>
                    <select class="form-control" id="status_pemesanan" name="status_pemesanan" required>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Dikonfirmasi">Dikonfirmasi</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-maroon">Simpan</button>
            <a href="{{ route('pemesanans.index') }}" class="btn btn-secondary">Keluar</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_paket').change(function() {
                var paketId = $(this).val();
                $.ajax({
                    url: '/getPaket',
                    type: 'GET',
                    data: { id_paket: paketId },
                    success: function(data) {
                        if (data.Paket) {
                            // Lakukan sesuatu dengan data.Paket.harga jika diperlukan
                            console.log(data.Paket.harga);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
@endsection
