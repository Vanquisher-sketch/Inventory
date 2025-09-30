@extends('layouts.app')
@section('title', 'KIB C - E-Gedung dan Bangunan')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kartu Inventaris Barang (KIB) C - E-Gedung & Bangunan</h6>
                <a href="{{ route('egedung.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data Baru</a>
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
                            <th rowspan="2" class="align-middle">Kondisi</th>
                            <th colspan="2">Konstruksi</th>
                            <th rowspan="2" class="align-middle">Luas Lantai (M²)</th>
                            <th rowspan="2" class="align-middle">Alamat</th>
                            <th colspan="2">Dokumen</th>
                            <th rowspan="2" class="align-middle">Luas Tanah (M²)</th>
                            <th rowspan="2" class="align-middle">Status Tanah</th>
                            <th rowspan="2" class="align-middle">Kode Tanah</th>
                            <th rowspan="2" class="align-middle">Asal-usul</th>
                            <th rowspan="2" class="align-middle">Harga (Rp)</th>
                            <th rowspan="2" class="align-middle">Keterangan</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Register</th>
                            <th>Bertingkat</th>
                            <th>Beton</th>
                            <th>Tanggal</th>
                            <th>Nomor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($egedungItems as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td class="text-center">{{ $item->register }}</td>
                            <td class="text-center">{{ $item->kondisi }}</td>
                            <td class="text-center">{{ $item->bertingkat ? 'Ya' : 'Tidak' }}</td>
                            <td class="text-center">{{ $item->beton ? 'Ya' : 'Tidak' }}</td>
                            <td class="text-center">{{ number_format($item->luas_lantai) }}</td>
                            <td>{{ $item->letak }}</td>
                            <td class="text-center">
                                @if($item->dokumen_tanggal)
                                    {{ \Carbon\Carbon::parse($item->dokumen_tanggal)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->dokumen_nomor ?? '-' }}</td>
                            <td class="text-center">{{ number_format($item->luas_tanah) }}</td>
                            <td>{{ $item->status_tanah ?? '-' }}</td>
                            <td>{{ $item->kode_tanah ?? '-' }}</td>
                            <td>{{ $item->asal_usul }}</td>
                            <td class="text-right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('egedung.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('egedung.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');" style="display:inline;">
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
                            <td colspan="18" class="text-center">Tidak ada data E-Gedung & Bangunan yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
