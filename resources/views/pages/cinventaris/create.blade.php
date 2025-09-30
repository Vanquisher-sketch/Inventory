@extends('layouts.app')
@section('title', 'Tambah Data C-Inventaris')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data C-Inventaris</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('cinventaris.store') }}" method="POST">
                @csrf
                {{-- Form fields from 'inventaris' create --}}
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
                 <div class="form-group">
                    <label>C-Room</label>
                    <select name="croom_id" class="form-control" required>
                        <option value="">Pilih C-Room</option>
                        @foreach($crooms as $croom)
                            <option value="{{ $croom->id }}">{{ $croom->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('cinventaris.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
