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
        .btn-maroon {
            background-color: #800000; /* Warna maroon */
            color: white; /* Warna teks putih */
        }
        .btn-maroon:hover {
            background-color: #600000; /* Warna maroon lebih gelap saat hover */
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Pelanggan</h1>
        <form action="{{ route('customers.update', $customer->id_customer) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put" />
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $customer->nama }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $customer->nomor_telepon }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required>{{ $customer->alamat }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki" {{ $customer->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $customer->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $customer->tanggal_lahir }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="paspor" class="form-label">Paspor</label>
                    <select class="form-control @error('paspor') is-invalid @enderror" id="paspor" name="paspor" required>
                        <option value="Sudah ada">Sudah ada</option>
                        <option value="Belum ada">Belum ada</option>
                    </select>
                    @error('paspor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="paspor_photo" class="form-label">Foto Paspor(opsional)</label>
                    <input type="file" class="form-control @error('paspor_photo') is-invalid @enderror" name="paspor_photo">
                    @error('paspor_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ktp_photo" class="form-label">Foto KTP</label>
                    <input type="file" class="form-control @error('ktp_photo') is-invalid @enderror" name="ktp_photo">
                    @error('ktp_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            <button type="submit" class="btn btn-maroon">Perbarui</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Keluar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
