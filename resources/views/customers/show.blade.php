@extends('layout.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #800000;
            color: white;
        }
        .btn-maroon {
            background-color: #800000;
            color: white;
        }
        .btn-maroon:hover {
            background-color: #600000;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .info-item span {
            font-weight: bold;
        }
        .image-container {
            display: flex; /* Menggunakan Flexbox untuk mengatur foto dalam satu baris */
            gap: 20px; /* Jarak antar gambar */
            align-items: center; /* Menyelaraskan gambar secara vertikal */
        }
        .image-container img {
            width: 100px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .image-container img:hover {
            transform: scale(1.1);
        }
        .modal-content {
            background-color: #000;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <div class="info-container">
        <div class="card">
            <div class="card-header">
                Detail Pelanggan
            </div>
            <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 info-item">
                    <span>Nama: </span> {{ $customer->nama }}
                </div>
                <div class="col-md-6 info-item">
                    <span>Email: </span> {{ $customer->email }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 info-item">
                    <span>Nomor Telepon: </span> {{ $customer->nomor_telepon }}
                </div>
                <div class="col-md-6 info-item">
                    <span>Alamat: </span> {{ $customer->alamat }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 info-item">
                    <span>Jenis Kelamin: </span> {{ $customer->jenis_kelamin }}
                </div>
                <div class="col-md-6 info-item">
                    <span>Tanggal Lahir: </span> {{ $customer->tanggal_lahir }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 info-item">
                    <span>Paspor: </span> {{ $customer->paspor }}
                </div>
                <div class="info-item image-container">
                    <span>Foto:</span>
                    @if ($customer->paspor_photo)
                        <img src="{{ asset('storage/'.$customer->paspor_photo) }}" data-bs-toggle="modal" data-bs-target="#passportModal" alt="Foto Paspor">
                    @else
                        <span>Tidak ada foto paspor</span>
                    @endif
                    @if ($customer->ktp_photo)
                        <img src="{{ asset('storage/'.$customer->ktp_photo) }}" data-bs-toggle="modal" data-bs-target="#ktpModal" alt="Foto KTP">
                    @else
                        <span>Tidak ada foto KTP</span>
                    @endif
                </div>
            </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('customers.edit', $customer->id_customer) }}" class="btn btn-warning">Edit</a>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal for Passport -->
    <div class="modal fade" id="passportModal" tabindex="-1" aria-labelledby="passportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('storage/'.$customer->paspor_photo) }}" alt="Detail Foto Paspor">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for KTP -->
    <div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('storage/'.$customer->ktp_photo) }}" alt="Detail Foto KTP">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
