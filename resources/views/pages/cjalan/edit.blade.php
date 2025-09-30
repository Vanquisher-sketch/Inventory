@extends('layouts.app')
@section('title', 'Edit Data C-Jalan')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data C-Jalan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('cjalan.update', $cjalan->id) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Form fields from 'jalan' edit form --}}
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $cjalan->nama_barang }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('cjalan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
