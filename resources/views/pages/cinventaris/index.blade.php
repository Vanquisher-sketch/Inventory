@extends('layouts.app')
@section('title', 'Data C-Inventaris')
@section('content')
<div class="container-fluid">
    {{-- Filter form from 'inventaris' --}}
    <div class="card shadow mb-4">
        <div class="card-body">
             <form action="{{ route('cinventaris.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label>Filter Berdasarkan C-Room:</label>
                        <select name="croom_id" class="form-control">
                            <option value="">Semua</option>
                            @foreach ($crooms as $croom)
                                <option value="{{ $croom->id }}" {{ request('croom_id') == $croom->id ? 'selected' : '' }}>
                                    {{ $croom->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data C-Inventaris {{ $selectedCroom->name ?? '' }}</h6>
                <a href="{{ route('cinventaris.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            {{-- Table from 'inventaris' --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>C-Room</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cinventarisItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->croom->name ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('cinventaris.destroy', $item->id) }}" method="POST">
                                    <a href="{{ route('cinventaris.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Data kosong.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
