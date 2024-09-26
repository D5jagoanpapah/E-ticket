@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container mt-5">
        <h2 class="mb-4">Cetak Laporan</h2>
        <form action="{{ route('cetak.laporan') }}" method="GET">
            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">Tanggal Mulai:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate }}" required>
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">Tanggal Akhir:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Tampilkan Data</button>
            <a href="{{ route('export.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-success mb-3">Cetak Laporan Excel</a>
        </form>

        @if(!empty($data))
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Paket</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Jumlah Peserta</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->customer->nama }}</td>
                        <td>{{ $item->customer->nomor_telepon }}</td>
                        <td>{{ $item->customer->alamat }}</td>
                        <td>{{ $item->customer->jenis_kelamin }}</td>
                        <td>{{ $item->paket->nama_paket}}</td>
                        <td>{{ $item->tanggal_pemesanan }}</td>
                        <td>{{ $item->jumlah_peserta }}</td>
                        <td>{{ optional($item->pembayaran)->jumlah_pembayaran ?? '-' }}</td>
                        <td>{{ optional($item->pembayaran)->tanggal_pembayaran ?? '-' }}</td>
                        <td>{{ optional($item->pembayaran)->metode_pembayaran ?? '-' }}</td>
                        <td>{{ optional($item->pembayaran)->status_pembayaran ?? '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data yang ditemukan pada rentang tanggal yang dipilih.</p>
        @endif
    </div>
@endsection
</body>
</html>
