@extends('layout.template')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Pemesanan Tiket</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Card Total Tiket Terjual -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Tiket Terjual</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">1,500</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card Total Pendapatan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pendapatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$120,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Keluhan Pelanggan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Keluhan Pelanggan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Tiket yang Tersedia -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tiket Tersedia</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">200</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-plane fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pemesanan Tiket -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan Tiket</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Pemesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>John Doe</td>
                        <td>2024-09-01</td>
                        <td><span class="badge badge-success">Lunas</span></td>
                        <td>$100</td>
                        <td><button class="btn btn-info btn-sm">Detail</button></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Jane Smith</td>
                        <td>2024-09-02</td>
                        <td><span class="badge badge-warning">Menunggu</span></td>
                        <td>$150</td>
                        <td><button class="btn btn-info btn-sm">Detail</button></td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Michael Johnson</td>
                        <td>2024-09-03</td>
                        <td><span class="badge badge-danger">Dibatalkan</span></td>
                        <td>$80</td>
                        <td><button class="btn btn-info btn-sm">Detail</button></td>
                    </tr>
                    <tr>
                        <td>004</td>
                        <td>Sarah Connor</td>
                        <td>2024-09-04</td>
                        <td><span class="badge badge-success">Lunas</span></td>
                        <td>$200</td>
                        <td><button class="btn btn-info btn-sm">Detail</button></td>
                    </tr>
                    <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Grafik Pendapatan -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Bulanan</h6>
    </div>
    <div class="card-body">
        <canvas id="revenueChart" width="100%" height="40"></canvas>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Pendapatan ($)',
                data: [12000, 19000, 30000, 25000, 32000, 40000, 50000],
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
            }],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>
@endsection
