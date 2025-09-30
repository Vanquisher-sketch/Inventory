@extends('layouts.app')
@section('title', 'Edit Data C-Inventaris')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data C-Inventaris</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('cinventaris.update', $cinventari->id) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Form fields from 'inventaris' edit --}}
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $cinventari->nama_barang }}" required>
                </div>
                <div class="form-group">
                    <label>C-Room</label>
                    <select name="croom_id" class="form-control" required>
                        @foreach($crooms as $croom)
                            <option value="{{ $croom->id }}" {{ $cinventari->croom_id == $croom->id ? 'selected' : '' }}>
                                {{ $croom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('cinventaris.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
