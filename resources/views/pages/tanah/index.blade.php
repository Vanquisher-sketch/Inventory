@extends('layouts.app')
@section('title', 'KIB A - Tanah')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kartu Inventaris Barang (KIB) A - Tanah</h6>
                <a href="{{ route('tanah.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data Tanah</a>
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
                            <th rowspan="2" class="align-middle">No Urut</th>
                            <th rowspan="2" class="align-middle">Nama Barang / Jenis Barang</th>
                            <th colspan="2">Nomor</th>
                            <th rowspan="2" class="align-middle">Luas (M²)</th>
                            <th rowspan="2" class="align-middle">Tahun Pengadaan</th>
                            <th rowspan="2" class="align-middle">Letak / Alamat</th>
                            <th colspan="3">Status Tanah</th>
                            <th rowspan="2" class="align-middle">Penggunaan</th>
                            <th rowspan="2" class="align-middle">Asal Usul</th>
                            <th rowspan="2" class="align-middle">Harga (Rp)</th>
                            <th rowspan="2" class="align-middle">Keterangan</th>
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
                        @forelse ($tanahItems as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td class="text-center">{{ $item->register }}</td>
                            <td class="text-center">{{ number_format($item->luas) }}</td>
                            <td class="text-center">{{ $item->tahun_pengadaan }}</td>
                            <td>{{ $item->letak }}</td>
                            <td class="text-center">{{ $item->hak ?? '-' }}</td>
                            <td class="text-center">
                                {{-- Format tanggal jika tidak null --}}
                                @if($item->sertifikat_tanggal)
                                    {{ \Carbon\Carbon::parse($item->sertifikat_tanggal)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->sertifikat_nomor ?? '-' }}</td>
                            <td>{{ $item->penggunaan }}</td>
                            <td>{{ $item->asal_usul }}</td>
                            <td class="text-right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('tanah.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('tanah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');" style="display:inline;">
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
                            <td colspan="15" class="text-center">Tidak ada data tanah yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection