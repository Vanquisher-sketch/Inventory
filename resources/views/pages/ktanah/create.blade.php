@extends('layouts.app')
@section('title', 'Tambah Data K-Tanah')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data K-Tanah</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ktanah.store') }}" method="POST">
                @csrf
                {{-- Form fields adapted from 'tanah' create form --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang') }}" required>
                        </div>
                        {{-- Add other fields from left column --}}
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label>Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
                        </div>
                        {{-- Add other fields from right column --}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('ktanah.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
