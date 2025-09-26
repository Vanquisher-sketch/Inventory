@extends('layouts.app')
@section('title', 'KIB B - Peralatan dan Mesin')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kartu Inventaris Barang (KIB) B - Peralatan & Mesin</h6>
                <a href="{{ route('peralatan.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data Baru</a>
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
                    {{-- Header Tabel Kompleks Sesuai Gambar --}}
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Kode Barang</th>
                            <th rowspan="2" class="align-middle">Nama Barang</th>
                            <th rowspan="2" class="align-middle">Register</th>
                            <th rowspan="2" class="align-middle">Merk / Tipe</th>
                            <th rowspan="2" class="align-middle">Ukuran / CC</th>
                            <th rowspan="2" class="align-middle">Bahan</th>
                            <th rowspan="2" class="align-middle">Tahun Beli</th>
                            <th colspan="5">Nomor</th>
                            <th rowspan="2" class="align-middle">Asal Usul</th>
                            <th rowspan="2" class="align-middle">Harga (Rp)</th>
                            <th rowspan="2" class="align-middle">Keterangan</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <th>Pabrik</th>
                            <th>Rangka</th>
                            <th>Mesin</th>
                            <th>Polisi</th>
                            <th>BPKB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peralatanItems as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td class="text-center">{{ $item->nomor_register }}</td>
                            <td>{{ $item->merk_tipe ?? '-' }}</td>
                            <td class="text-center">{{ $item->ukuran_cc ?? '-' }}</td>
                            <td>{{ $item->bahan ?? '-' }}</td>
                            <td class="text-center">{{ $item->tahun_pembelian }}</td>
                            <td>{{ $item->nomor_pabrik ?? '-' }}</td>
                            <td>{{ $item->nomor_rangka ?? '-' }}</td>
                            <td>{{ $item->nomor_mesin ?? '-' }}</td>
                            <td>{{ $item->nomor_polisi ?? '-' }}</td>
                            <td>{{ $item->nomor_bpkb ?? '-' }}</td>
                            <td>{{ $item->asal_usul }}</td>
                            <td class="text-right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('peralatan.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('peralatan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');" style="display:inline;">
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
                            {{-- Sesuaikan colspan dengan jumlah total kolom di baris paling bawah header --}}
                            <td colspan="17" class="text-center">Tidak ada data peralatan & mesin yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection