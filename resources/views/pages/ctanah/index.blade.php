@extends('layouts.app')
@section('title', 'KIB A - C-Tanah')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kartu Inventaris Barang (KIB) A - C-Tanah</h6>
                <a href="{{ route('ctanah.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data Baru</a>
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
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Nama Barang</th>
                            <th colspan="2">Nomor</th>
                            <th rowspan="2" class="align-middle">Luas (M²)</th>
                            <th rowspan="2" class="align-middle">Tahun</th>
                            <th rowspan="2" class="align-middle">Letak</th>
                            <th colspan="3">Status Tanah</th>
                            <th rowspan="2" class="align-middle">Penggunaan</th>
                            <th rowspan="2" class="align-middle">Asal Usul</th>
                            <th rowspan="2" class="align-middle">Harga (Rp)</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Register</th>
                            <th>Hak</th>
                            <th>Tgl. Sertifikat</th>
                            <th>No. Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ctanahItems as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->register }}</td>
                            <td>{{ number_format($item->luas) }}</td>
                            <td>{{ $item->tahun_pengadaan }}</td>
                            <td>{{ $item->letak }}</td>
                            <td>{{ $item->hak ?? '-' }}</td>
                            <td>{{ $item->sertifikat_tanggal ? \Carbon\Carbon::parse($item->sertifikat_tanggal)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->sertifikat_nomor ?? '-' }}</td>
                            <td>{{ $item->penggunaan }}</td>
                            <td>{{ $item->asal_usul }}</td>
                            <td class="text-right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('ctanah.destroy', $item->id) }}" method="POST">
                                    <a href="{{ route('ctanah.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14" class="text-center">Data kosong.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
