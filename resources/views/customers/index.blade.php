@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Umroh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: bold;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .table-bordered td, .table-bordered th {
            border-color: #b0b0b0;
        }
        /* Styling untuk tombol */
        .btn-primary {
            background-color: #800000;
            border-color: #660000;
        }
        .btn-primary:hover {
            background-color: #660000;
            border-color: #4d0000;
        }
        .btn-primary:focus, .btn-primary:active {
            box-shadow: none !important; 
            outline: none !important; 
            background-color: #800000 !important; 
            border-color: #660000 !important; 
        }
        .btn-danger {
            background-color: #800000;
            border-color: #660000;
        }
        .btn-danger:hover {
            background-color: #660000;
            border-color: #4d0000;
        }
        .btn-info {
            background-color: #ffc107;
            border-color: #e0a800;
        }
        .btn-info:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn {
            padding: 5px 10px; /* Kurangi padding untuk membuat tombol lebih kecil */
            font-size: 0.875rem; /* Sesuaikan ukuran teks */
        }
        .input-group {
            max-width: 250px; /* Mengatur lebar maksimum untuk input pencarian */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container">
    @if(auth()->user()->role === 'admin')
        <h1>Daftar Pelanggan</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Tambah Data Pelanggan</a>
    <form action="{{ route('customers.index') }}" method="GET" class="input-group" style="width: 250px;">
        <input type="text" name="search" class="form-control" placeholder="Cari Pelanggan" aria-label="Cari Pelanggan">
        <button class="btn btn-outline-secondary" type="submit">Cari</button>
    </form>
</div>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
        <div class="table-container mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Paspor</th>
                        <th>Foto Paspor</th>
                        <th>Foto KTP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->nama }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->nomor_telepon }}</td>
                        <td>{{ $customer->alamat }}</td>
                        <td>{{ $customer->jenis_kelamin }}</td>
                        <td>{{ $customer->tanggal_lahir }}</td>
                        <td>{{ $customer->paspor }}</td>
                        <td class="text-center">
                        <img src="{{ asset('storage/'.$customer->paspor_photo) }}" class="rounded" style="width:50px">
                        </td>
                        <td class="text-center">
                        <img src="{{ asset('storage/'.$customer->ktp_photo) }}" class="rounded" style="width:50px">
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('customers.show', $customer->id_customer) }}" class="btn btn-info btn-sm d-flex align-items-center justify-content-center" title="Lihat" style="width: 32px; height: 32px;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('customers.edit', $customer->id_customer) }}" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center" title="Edit" style="width: 32px; height: 32px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $customer->id_customer) }}" method="POST" style="display:inline-block;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            @else
        <div class="alert alert-warning">
            Anda tidak memiliki akses untuk melihat daftar pelanggan.
        </div>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Buat Pelanggan Baru</a>
    @endif
        </div>
    </div>
@endsection
</body>
</html>
