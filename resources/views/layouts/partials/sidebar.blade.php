@php
    // Query untuk daftar ruangan di menu shortcut
    $roomForSidebar = \App\Models\Room::orderBy('name', 'asc')->get();

    // Logika untuk state aktif menu Manajemen Aset
    $isAssetMenuActive = request()->is('room*') || request()->is('tanah*') || request()->is('gedung*') || request()->is('peralatan*') || request()->is('jalan*') || request()->is('rusak*');
    
    // Logika untuk state aktif menu Inventaris Ruangan
    $isInventarisMenuActive = request()->is('*/inventaris*');
@endphp

<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/tsk.png') }}" alt="Logo" style="width: 40px; border-radius: 50%;">
        </div>
        <div class="sidebar-brand-text mx-3">INVENTORY</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Kecamatan Tawang
    </div>

    <li class="nav-item {{ $isAssetMenuActive && !$isInventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAset" aria-expanded="true" aria-controls="collapseAset">
            <i class="fas fa-fw fa-archive"></i>
            <span>Manajemen Aset</span>
        </a>
        <div id="collapseAset" class="collapse {{ $isAssetMenuActive && !$isInventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingAset" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('room*') ? 'active' : '' }}" href="{{ route('room.index') }}">Daftar Ruangan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Kartu Inventaris Barang:</h6>
                <a class="collapse-item {{ request()->is('tanah*') ? 'active' : '' }}" href="{{ route('tanah.index') }}">KIB A - Tanah</a>
                <a class="collapse-item {{ request()->is('peralatan*') ? 'active' : '' }}" href="{{ route('peralatan.index') }}">KIB B - Peralatan</a>
                <a class="collapse-item {{ request()->is('gedung*') ? 'active' : '' }}" href="{{ route('gedung.index') }}">KIB C - Gedung</a>
                <a class="collapse-item {{ request()->is('jalan*') ? 'active' : '' }}" href="{{ route('jalan.index') }}">KIB D - Jalan & Jaringan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan Kondisi:</h6>
                <a class="collapse-item {{ request()->is('rusak*') ? 'active' : '' }}" href="{{ route('rusak.index') }}">Barang Rusak Berat</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ $isInventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventaris" aria-expanded="true" aria-controls="collapseInventaris">
            <i class="fas fa-fw fa-search-location"></i>
            <span>Inventaris Ruangan</span>
        </a>
        <div id="collapseInventaris" class="collapse {{ $isInventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingInventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih Ruangan:</h6>
                <div style="max-height: 250px; overflow-y: auto;">
                    @forelse ($roomForSidebar as $room)
                        <a class="collapse-item {{ request()->is('room/*/inventaris*') && optional(request()->route('room'))->id == $room->id ? 'active' : '' }}" 
                           href="{{ route('inventaris.index', $room->id) }}">
                            {{ $room->name }}
                        </a>
                    @empty
                        <span class="collapse-item">Belum ada data ruangan</span>
                    @endforelse
                </div>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>