@extends('layout.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard Pemesanan Umroh</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row mt-4">
            <!-- Card untuk total jumlah peserta -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Tiket Yang Terjual</div>
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-ticket-alt fa-2x me-2"></i>
                        <h5 class="card-title mb-0">{{ isset($total_jumlah_peserta) ? $total_jumlah_peserta : 'Data tidak tersedia' }}</h5>
                    </div>
                </div>
            </div>

            <!-- Card untuk total stok tiket -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Total Stok Paket</div>
                    <div class="card-body d-flex align-items-center bg-warning">
                        <i class="fas fa-box fa-2x me-2"></i>
                        <h5 class="card-title mb-0">{{ isset($total_stok_tiket) ? $total_stok_tiket : 'Data tidak tersedia' }}</h5>
                    </div>
                </div>
            </div>

            <!-- Card untuk menunggu konfirmasi -->
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Menunggu Konfirmasi</div>
                    <div class="card-body d-flex align-items-center bg-danger">
                        <i class="fas fa-clock fa-2x me-2"></i>
                        <h5 class="card-title mb-0">{{ isset($menunggu_konfirmasi) ? $menunggu_konfirmasi : 'Data tidak tersedia' }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Grafik pendapatan -->
        <h2 class="mt-4">Grafik Pendapatan Bulanan</h2>
        <canvas id="pendapatanChart" class="mt-2"></canvas>

        <script>
            const ctxPendapatan = document.getElementById('pendapatanChart').getContext('2d');
            const bulan = @json($bulan);
            const dataPendapatan = @json($data_pendapatan);

            const pendapatanChart = new Chart(ctxPendapatan, {
                type: 'line',
                data: {
                    labels: bulan,
                    datasets: [{
                        label: 'Total Pendapatan',
                        data: dataPendapatan,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script> --}}
    </div>
@endsection
