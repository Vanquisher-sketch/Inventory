@extends('layouts.app')
@section('title', 'Edit Data Jalan, Irigasi & Jaringan')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data (KIB D)</h6>
                <a href="{{ route('jalan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif
            <form action="{{ route('jalan.update', $jalan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $jalan->nama_barang) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang', $jalan->kode_barang) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Register <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_register" class="form-control" value="{{ old('nomor_register', $jalan->nomor_register) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Konstruksi <span class="text-danger">*</span></label>
                            <input type="text" name="konstruksi" class="form-control" value="{{ old('konstruksi', $jalan->konstruksi) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Panjang (KM)</label>
                            <input type="number" step="any" name="panjang" class="form-control" value="{{ old('panjang', $jalan->panjang) }}">
                        </div>
                        <div class="form-group">
                            <label>Lebar (M)</label>
                            <input type="number" step="any" name="lebar" class="form-control" value="{{ old('lebar', $jalan->lebar) }}">
                        </div>
                        <div class="form-group">
                            <label>Luas (M²)</label>
                            <input type="number" step="any" name="luas" class="form-control" value="{{ old('luas', $jalan->luas) }}">
                        </div>
                        <div class="form-group">
                            <label>Letak / Lokasi <span class="text-danger">*</span></label>
                            <textarea name="letak" class="form-control" rows="2" required>{{ old('letak', $jalan->letak) }}</textarea>
                        </div>
                    </div>
                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Dokumen</label>
                            <input type="date" name="dokumen_tanggal" class="form-control" value="{{ old('dokumen_tanggal', $jalan->dokumen_tanggal) }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Dokumen</label>
                            <input type="text" name="dokumen_nomor" class="form-control" value="{{ old('dokumen_nomor', $jalan->dokumen_nomor) }}">
                        </div>
                        <div class="form-group">
                            <label>Status Tanah <span class="text-danger">*</span></label>
                            <input type="text" name="status_tanah" class="form-control" value="{{ old('status_tanah', $jalan->status_tanah) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Kode Tanah</label>
                            <input type="text" name="kode_tanah" class="form-control" value="{{ old('kode_tanah', $jalan->kode_tanah) }}">
                        </div>
                        <div class="form-group">
                            <label>Asal Usul <span class="text-danger">*</span></label>
                            <input type="text" name="asal_usul" class="form-control" value="{{ old('asal_usul', $jalan->asal_usul) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga', $jalan->harga) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kondisi <span class="text-danger">*</span></label>
                            <select name="kondisi" class="form-control" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="B" {{ old('kondisi', $jalan->kondisi) == 'B' ? 'selected' : '' }}>Baik (B)</option>
                                <option value="KB" {{ old('kondisi', $jalan->kondisi) == 'KB' ? 'selected' : '' }}>Kurang Baik (KB)</option>
                                <option value="RB" {{ old('kondisi', $jalan->kondisi) == 'RB' ? 'selected' : '' }}>Rusak Berat (RB)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $jalan->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('jalan.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection