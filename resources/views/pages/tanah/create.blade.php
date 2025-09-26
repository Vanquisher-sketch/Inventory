@extends('layouts.app')
@section('title', 'Tambah Data Tanah')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data Tanah (KIB A)</h6>
                <a href="{{ route('tanah.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left fa-sm"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('tanah.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="register">Register <span class="text-danger">*</span></label>
                            <input type="text" name="register" class="form-control" value="{{ old('register') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="luas">Luas (M²) <span class="text-danger">*</span></label>
                            <input type="number" name="luas" class="form-control" value="{{ old('luas') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tahun_pengadaan">Tahun Pengadaan <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_pengadaan" class="form-control" placeholder="YYYY" value="{{ old('tahun_pengadaan') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="letak">Letak / Alamat <span class="text-danger">*</span></label>
                            <textarea name="letak" class="form-control" rows="3" required>{{ old('letak') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hak">Hak</label>
                            <input type="text" name="hak" class="form-control" value="{{ old('hak') }}">
                        </div>
                        <div class="form-group">
                            <label for="sertifikat_tanggal">Tanggal Sertifikat</label>
                            <input type="date" name="sertifikat_tanggal" class="form-control" value="{{ old('sertifikat_tanggal') }}">
                        </div>
                        <div class="form-group">
                            <label for="sertifikat_nomor">Nomor Sertifikat</label>
                            <input type="text" name="sertifikat_nomor" class="form-control" value="{{ old('sertifikat_nomor') }}">
                        </div>
                        <div class="form-group">
                            <label for="penggunaan">Penggunaan <span class="text-danger">*</span></label>
                            <input type="text" name="penggunaan" class="form-control" value="{{ old('penggunaan') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="asal_usul">Asal Usul <span class="text-danger">*</span></label>
                            <input type="text" name="asal_usul" class="form-control" value="{{ old('asal_usul') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('tanah.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection