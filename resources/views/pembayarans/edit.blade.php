@extends('layout.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Pembayaran</h1>
        <form action="{{ route('pembayarans.update', $pembayaran->id_pembayaran) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put" />
            <div class="mb-3">
                <label for="id_pemesanan" class="form-label">Nama</label>
                <select name="id_pemesanan" id="id_pemesanan" class="form-select" required>
                    @foreach($pemesanans as $pemesanan)
                        <option value="{{ $pemesanan->id_pemesanan }}" {{ $pembayaran->id_pemesanan == $pemesanan->id_pemesanan ? 'selected' : '' }}>
                            {{ $pemesanan->customer->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" value="{{ $pembayaran->jumlah_pembayaran }}" readonly>
            </div>
            <div class="mb-3">
                <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" value="{{ $pembayaran->tanggal_pembayaran }}" required>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="form-control" value="{{ $pembayaran->metode_pembayaran }}" required>
            </div>
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="form-select" required>
                    <option value="berhasil" {{ $pembayaran->status_pembayaran == 'berhasil' ? 'selected' : '' }}>Berhasil</option>
                    <option value="gagal" {{ $pembayaran->status_pembayaran == 'gagal' ? 'selected' : '' }}>Gagal</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('pembayarans.index') }}" class="btn btn-secondary">Keluar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
