@extends('layouts.app')
@section('title', 'Edit Data C-Gedung')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data C-Gedung</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('cgedung.update', $cgedung->id) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Include your form fields here based on the 'gedung' edit form --}}
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $cgedung->nama_barang }}" required>
                </div>
                {{-- Add all other fields for Cgedung here, populated with $cgedung data --}}
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('cgedung.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
