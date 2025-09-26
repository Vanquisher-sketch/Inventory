@extends('layouts.app')
@section('title', 'Data Barang Rusak')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang Rusak Berat</h6>
                <a href="{{ route('rusak.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data Baru</a>
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
                            <th>No. Urut</th>
                            <th>No. ID Pemda</th>
                            <th>Nama / Jenis Barang</th>
                            <th>Spesifikasi</th>
                            <th>No. Polisi</th>
                            <th>Tahun Perolehan</th>
                            <th>Harga Perolehan (Rp)</th>
                            <th>Kondisi</th>
                            <th>Tercatat di KIB</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rusakItems as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->no_id_pemda }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->spesifikasi ?? '-' }}</td>
                            <td class="text-center">{{ $item->no_polisi ?? '-' }}</td>
                            <td class="text-center">{{ $item->tahun_perolehan }}</td>
                            <td class="text-right">{{ number_format($item->harga_perolehan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->kondisi }}</td>
                            <td class="text-center">{{ $item->tercatat_di_kib }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('rusak.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('rusak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');" style="display:inline;">
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
                            <td colspan="11" class="text-center">Tidak ada data barang rusak yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection