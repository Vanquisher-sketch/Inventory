@extends('layouts.app')

@section('title', 'Data Inventaris')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('inventaris.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="room_id_filter">Filter Berdasarkan Ruangan:</label>
                        <select name="room_id" id="room_id_filter" class="form-control">
                            <option value="">Tampilkan Semua</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ request()->get('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
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
                <h4 class="m-0 font-weight-bold text-primary">
                    Data Inventaris {{ $selectedRoom->name ?? 'Semua Ruangan' }}
                </h4>
                <div>
                    {{-- Tombol Print PDF --}}
                    <a href="{{ route('inventaris.print', request()->query()) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf fa-sm"></i> Export PDF
                    </a>
                    {{-- Tombol Tambah --}}
                    <a href="{{ route('inventaris.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus fa-sm"></i> Tambah Barang
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            
            {{-- KODE BARU DENGAN TOMBOL CLOSE --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{-- Pesan sukses Anda --}}
        <strong>Sukses!</strong> {{ session('success') }}
        
        {{-- Tombol close (x) --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                    <thead class="text-center">
                        {{-- Header tabel sekarang disesuaikan 100% dengan foto --}}
                        <tr>
                            <th rowspan="2" class="align-middle">No Urut</th>
                            <th rowspan="2" class="align-middle">Nama Barang / Jenis Barang</th>
                            <th rowspan="2" class="align-middle">Merk / Model</th>
                            <th rowspan="2" class="align-middle">Bahan</th>
                            <th rowspan="2" class="align-middle">Tahun Pembelian</th>
                            <th rowspan="2" class="align-middle">No. Kode Barang</th>
                            <th rowspan="2" class="align-middle">Lokasi Ruangan</th>
                            <th rowspan="2" class="align-middle">Jumlah</th>
                            <th rowspan="2" class="align-middle">Harga Beli (Rp)</th>
                            <th colspan="3">Keadaan Barang</th>
                            <th rowspan="2" class="align-middle">Keterangan</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <th>Baik (B)</th>
                            <th>Kurang Baik (KB)</th>
                            <th>Rusak Berat (RB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inventaris as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->merk_model ?? '-' }}</td>
                                <td>{{ $item->bahan ?? '-' }}</td>
                                <td class="text-center">{{ $item->tahun_pembelian ?? '-' }}</td>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->room->name ?? 'N/A' }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                                <td class="text-right">{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->kondisi_baik }}</td>
                                <td class="text-center">{{ $item->kondisi_kurang_baik }}</td>
                                <td class="text-center">{{ $item->kondisi_rusak_berat }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('inventaris.edit', $item->id) }}" class="btn btn-warning btn-sm mr-1" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                {{-- Sesuaikan colspan dengan jumlah total kolom header --}}
                                <td colspan="14" class="text-center">
                                    Tidak ada data inventaris ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection