@extends('layouts.app')
@section('title', 'Edit Data Gedung & Bangunan')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Gedung (KIB C)</h6>
                <a href="{{ route('gedung.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif
            <form action="{{ route('gedung.update', $gedung->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $gedung->nama_barang) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang', $gedung->kode_barang) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Register <span class="text-danger">*</span></label>
                            <input type="text" name="register" class="form-control" value="{{ old('register', $gedung->register) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kondisi <span class="text-danger">*</span></label>
                            <select name="kondisi" class="form-control" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="B" {{ old('kondisi', $gedung->kondisi) == 'B' ? 'selected' : '' }}>Baik (B)</option>
                                <option value="KB" {{ old('kondisi', $gedung->kondisi) == 'KB' ? 'selected' : '' }}>Kurang Baik (KB)</option>
                                <option value="RB" {{ old('kondisi', $gedung->kondisi) == 'RB' ? 'selected' : '' }}>Rusak Berat (RB)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Luas Lantai (M²) <span class="text-danger">*</span></label>
                            <input type="number" name="luas_lantai" class="form-control" value="{{ old('luas_lantai', $gedung->luas_lantai) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Letak / Alamat <span class="text-danger">*</span></label>
                            <textarea name="letak" class="form-control" rows="2" required>{{ old('letak', $gedung->letak) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Konstruksi</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bertingkat" value="1" {{ old('bertingkat', $gedung->bertingkat) ? 'checked' : '' }}>
                                <label class="form-check-label">Bertingkat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="beton" value="1" {{ old('beton', $gedung->beton) ? 'checked' : '' }}>
                                <label class="form-check-label">Beton</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Dokumen</label>
                            <input type="date" name="dokumen_tanggal" class="form-control" value="{{ old('dokumen_tanggal', $gedung->dokumen_tanggal) }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Dokumen</label>
                            <input type="text" name="dokumen_nomor" class="form-control" value="{{ old('dokumen_nomor', $gedung->dokumen_nomor) }}">
                        </div>
                        <div class="form-group">
                            <label>Luas Tanah (M²) <span class="text-danger">*</span></label>
                            <input type="number" name="luas_tanah" class="form-control" value="{{ old('luas_tanah', $gedung->luas_tanah) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Status Tanah</label>
                            <input type="text" name="status_tanah" class="form-control" value="{{ old('status_tanah', $gedung->status_tanah) }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Kode Tanah</label>
                            <input type="text" name="kode_tanah" class="form-control" value="{{ old('kode_tanah', $gedung->kode_tanah) }}">
                        </div>
                        <div class="form-group">
                            <label>Asal Usul <span class="text-danger">*</span></label>
                            <input type="text" name="asal_usul" class="form-control" value="{{ old('asal_usul', $gedung->asal_usul) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga', $gedung->harga) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $gedung->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('gedung.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection