@extends('layout.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Pembayaran</h1>
        <form action="{{ route('pembayarans.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="id_pemesanan" class="form-label">Nama</label>
                <select name="id_pemesanan" id="id_pemesanan" class="form-select" required>
                    <option value="" disabled selected>Pilih Pemesanan</option>
                    @foreach($pemesanans as $pemesanan)
                        <option value="{{ $pemesanan->id_pemesanan }}">
                            {{ $pemesanan->customer ? $pemesanan->customer->nama : 'Customer tidak ditemukan' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>
            <!-- Hanya tampilkan field status pemesanan jika pengguna adalah admin -->
            @if (auth()->user() && auth()->user()->role == 'admin')
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="form-select" required>
                    <option value="berhasil">Berhasil</option>
                    <option value="gagal">Gagal</option>
                </select>
            </div>
            @endif
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pembayarans.index') }}" class="btn btn-secondary">Keluar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_pemesanan').change(function() {
                var pemesananId = $(this).val();
                $.ajax({
                    url: '/getPemesananData/' + pemesananId,
                    type: 'GET',
                    success: function(data) {
                        if (data.jumlah_pembayaran) {
                            $('#jumlah_pembayaran').val(data.jumlah_pembayaran);
                        } else {
                            $('#jumlah_pembayaran').val('');
                        }
                    },
                    error: function() {
                        $('#jumlah_pembayaran').val('Error');
                    }
                });
            });
        });
    </script>
</body>
</html>
@endsection
