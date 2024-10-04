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
        <form action="{{ route('laporan.index') }}" method="GET">
            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">Tanggal Mulai:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">Tanggal Akhir:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary me-2">Tampilkan Data</button>
                <a href="{{ route('export.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success">Cetak Laporan Excel</a>
            </div>
        </form>

        @if(request('start_date') && request('end_date')) <!-- Check if both dates are provided -->
            @if(isset($data) && count($data) > 0)
            <div class="table-responsive">
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
                            <td>{{ optional($item->customer)->nama ?? 'N/A' }}</td>
                            <td>{{ optional($item->customer)->nomor_telepon ?? 'N/A' }}</td>
                            <td>{{ optional($item->customer)->alamat ?? 'N/A' }}</td>
                            <td>{{ optional($item->customer)->jenis_kelamin ?? 'N/A' }}</td>
                            <td>{{ optional($item->paket)->nama_paket ?? 'N/A' }}</td>
                            <td>{{ $item->tanggal_pemesanan }}</td>
                            <td>{{ $item->jumlah_peserta }}</td>
                            <td>{{ optional($item->pembayaran)->jumlah_pembayaran ? 'Rp. ' . number_format($item->pembayaran->jumlah_pembayaran, 2, ',', '.') : '-' }}</td>
                            <td>{{ optional($item->pembayaran)->tanggal_pembayaran ?? '-' }}</td>
                            <td>{{ optional($item->pembayaran)->metode_pembayaran ?? '-' }}</td>
                            <td>{{ optional($item->pembayaran)->status_pembayaran ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            @else
                @if(request('start_date') || request('end_date'))
                    <p>Tidak ada data yang ditemukan pada rentang tanggal yang dipilih.</p>
                @endif
            @endif
        @endif
    </div>
@endsection
</body>
</html>
