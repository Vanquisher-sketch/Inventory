@extends('layouts.app')
@section('title', 'Edit Data Barang Rusak')
@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Barang Rusak</h6>
                        <a href="{{ route('rusak.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                    @endif
                    <form action="{{ route('rusak.update', $rusak->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>No. ID Pemda <span class="text-danger">*</span></label>
                            <input type="text" name="no_id_pemda" class="form-control" value="{{ old('no_id_pemda', $rusak->no_id_pemda) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Nama / Jenis Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $rusak->nama_barang) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Spesifikasi</label>
                            <textarea name="spesifikasi" class="form-control" rows="3">{{ old('spesifikasi', $rusak->spesifikasi) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>No. Polisi</label>
                            <input type="text" name="no_polisi" class="form-control" value="{{ old('no_polisi', $rusak->no_polisi) }}">
                        </div>
                        <div class="form-group">
                            <label>Tahun Perolehan <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_perolehan" class="form-control" placeholder="YYYY" value="{{ old('tahun_perolehan', $rusak->tahun_perolehan) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Perolehan (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga_perolehan" class="form-control" value="{{ old('harga_perolehan', $rusak->harga_perolehan) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kondisi <span class="text-danger">*</span></label>
                            <select name="kondisi" class="form-control" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="RB" {{ old('kondisi', $rusak->kondisi) == 'RB' ? 'selected' : '' }}>Rusak Berat (RB)</option>
                                <option value="B" {{ old('kondisi', $rusak->kondisi) == 'B' ? 'selected' : '' }}>Baik (B)</option>
                                <option value="KB" {{ old('kondisi', $rusak->kondisi) == 'KB' ? 'selected' : '' }}>Kurang Baik (KB)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tercatat di KIB <span class="text-danger">*</span></label>
                            <select name="tercatat_di_kib" class="form-control" required>
                                <option value="">-- Pilih KIB --</option>
                                <option value="KIB-A" {{ old('tercatat_di_kib', $rusak->tercatat_di_kib) == 'KIB-A' ? 'selected' : '' }}>KIB A - Tanah</option>
                                <option value="KIB-B" {{ old('tercatat_di_kib', $rusak->tercatat_di_kib) == 'KIB-B' ? 'selected' : '' }}>KIB B - Peralatan & Mesin</option>
                                <option value="KIB-C" {{ old('tercatat_di_kib', $rusak->tercatat_di_kib) == 'KIB-C' ? 'selected' : '' }}>KIB C - Gedung & Bangunan</option>
                                <option value="KIB-D" {{ old('tercatat_di_kib', $rusak->tercatat_di_kib) == 'KIB-D' ? 'selected' : '' }}>KIB D - Jalan, Irigasi & Jaringan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $rusak->keterangan) }}</textarea>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('rusak.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection