@extends('layouts.app')
@section('title', 'Tambah Data C-Tanah')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data C-Tanah</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ctanah.store') }}" method="POST">
                @csrf
                {{-- Include your form fields here based on the 'tanah' create form --}}
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
                {{-- Add all other fields for Ctanah here --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('ctanah.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
