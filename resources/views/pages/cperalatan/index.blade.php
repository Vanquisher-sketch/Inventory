@extends('layouts.app')
@section('title', 'KIB B - C-Peralatan')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kartu Inventaris Barang (KIB) B - C-Peralatan</h6>
                <a href="{{ route('cperalatan.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    {{-- Table header adapted from 'peralatan' --}}
                    <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama Barang</th>
                           <th>Kode Barang</th>
                           <th>Merk/Tipe</th>
                           <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cperalatanItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->merk_tipe ?? '-' }}</td>
                            <td>
                                <form action="{{ route('cperalatan.destroy', $item->id) }}" method="POST">
                                    <a href="{{ route('cperalatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
