@extends('layouts.app')
@section('title', 'Edit Data Peralatan & Mesin')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Peralatan (KIB B)</h6>
                <a href="{{ route('peralatan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif
            <form action="{{ route('peralatan.update', $peralatan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $peralatan->nama_barang) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang', $peralatan->kode_barang) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Register <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_register" class="form-control" value="{{ old('nomor_register', $peralatan->nomor_register) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Merk / Tipe</label>
                            <input type="text" name="merk_tipe" class="form-control" value="{{ old('merk_tipe', $peralatan->merk_tipe) }}">
                        </div>
                        <div class="form-group">
                            <label>Ukuran / CC</label>
                            <input type="text" name="ukuran_cc" class="form-control" value="{{ old('ukuran_cc', $peralatan->ukuran_cc) }}">
                        </div>
                        <div class="form-group">
                            <label>Bahan</label>
                            <input type="text" name="bahan" class="form-control" value="{{ old('bahan', $peralatan->bahan) }}">
                        </div>
                        <div class="form-group">
                            <label>Tahun Pembelian <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_pembelian" class="form-control" placeholder="YYYY" value="{{ old('tahun_pembelian', $peralatan->tahun_pembelian) }}" required>
                        </div>
                    </div>
                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Pabrik</label>
                            <input type="text" name="nomor_pabrik" class="form-control" value="{{ old('nomor_pabrik', $peralatan->nomor_pabrik) }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Rangka</label>
                            <input type="text" name="nomor_rangka" class="form-control" value="{{ old('nomor_rangka', $peralatan->nomor_rangka) }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Mesin</label>
                            <input type="text" name="nomor_mesin" class="form-control" value="{{ old('nomor_mesin', $peralatan->nomor_mesin) }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Polisi</label>
                            <input type="text" name="nomor_polisi" class="form-control" value="{{ old('nomor_polisi', $peralatan->nomor_polisi) }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor BPKB</label>
                            <input type="text" name="nomor_bpkb" class="form-control" value="{{ old('nomor_bpkb', $peralatan->nomor_bpkb) }}">
                        </div>
                        <div class="form-group">
                            <label>Asal Usul <span class="text-danger">*</span></label>
                            <input type="text" name="asal_usul" class="form-control" value="{{ old('asal_usul', $peralatan->asal_usul) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga', $peralatan->harga) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $peralatan->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('peralatan.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection