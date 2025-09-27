@php
    // Query untuk daftar ruangan di menu shortcut TAWANG
    $roomForSidebar = \App\Models\Room::orderBy('name', 'asc')->get();
    
    // Query untuk daftar K-Room di menu shortcut BARU
    $kroomForSidebar = \App\Models\Kroom::orderBy('name', 'asc')->get();

    // Logika untuk state aktif menu Aset TAWANG
    $isAssetMenuActive = request()->is('room*') || request()->is('tanah*') || request()->is('gedung*') || request()->is('peralatan*') || request()->is('jalan*') || request()->is('rusak*');
    
    // Logika untuk state aktif menu Inventaris Ruangan TAWANG
    $isInventarisMenuActive = request()->is('inventaris*');

    // Logika untuk state aktif menu Aset K-ROOM
    $isKroomAssetMenuActive = request()->is('kroom*') || request()->is('ktanah*') || request()->is('kgedung*') || request()->is('kperalatan*') || request()->is('kjalan*') || request()->is('krusak*');

    // Logika untuk state aktif menu K-Inventaris K-ROOM
    $isKinventarisMenuActive = request()->is('kinventaris*');
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/tsk.png') }}" alt="Logo" style="width: 40px; border-radius: 50%;">
        </div>
        <div class="sidebar-brand-text mx-3">INVENTORY</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading untuk Data Kecamatan Tawang -->
    <div class="sidebar-heading">
        Data Kecamatan Tawang
    </div>

    <!-- Nav Item - Manajemen Aset -->
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

    <!-- Nav Item - Inventaris Ruangan -->
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
                        {{-- PERBAIKAN: Link diubah agar mengirim parameter filter --}}
                        <a class="collapse-item {{ request('room_id') == $room->id ? 'active' : '' }}" 
                           href="{{ route('inventaris.index', ['room_id' => $room->id]) }}">
                            {{ $room->name }}
                        </a>
                    @empty
                        <span class="collapse-item">Belum ada data ruangan</span>
                    @endforelse
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- HEADING DAN MENU BARU UNTUK K-ROOM -->
    <div class="sidebar-heading">
        Data Kahuripan
    </div>

    <!-- Nav Item - Manajemen Aset K-Room -->
    <li class="nav-item {{ $isKroomAssetMenuActive && !$isKinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKroomAset" aria-expanded="true" aria-controls="collapseKroomAset">
            <i class="fas fa-fw fa-building"></i>
            <span>Manajemen Aset </span>
        </a>
        <div id="collapseKroomAset" class="collapse {{ $isKroomAssetMenuActive && !$isKinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingKroomAset" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('kroom*') ? 'active' : '' }}" href="{{ route('kroom.index') }}">Daftar K-Room</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Kartu Inventaris Barang:</h6>
                <a class="collapse-item {{ request()->is('ktanah*') ? 'active' : '' }}" href="{{ route('ktanah.index') }}">KIB A - K-Tanah</a>
                <a class="collapse-item {{ request()->is('kperalatan*') ? 'active' : '' }}" href="{{ route('kperalatan.index') }}">KIB B - K-Peralatan</a>
                <a class="collapse-item {{ request()->is('kgedung*') ? 'active' : '' }}" href="{{ route('kgedung.index') }}">KIB C - K-Gedung</a>
                <a class="collapse-item {{ request()->is('kjalan*') ? 'active' : '' }}" href="{{ route('kjalan.index') }}">KIB D - K-Jalan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan Kondisi:</h6>
                <a class="collapse-item {{ request()->is('krusak*') ? 'active' : '' }}" href="{{ route('krusak.index') }}">K-Barang Rusak</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - K-Inventaris Ruangan -->
    <li class="nav-item {{ $isKinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKinventaris" aria-expanded="true" aria-controls="collapseKinventaris">
            <i class="fas fa-fw fa-box-open"></i>
            <span>K-Inventaris</span>
        </a>
        <div id="collapseKinventaris" class="collapse {{ $isKinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingKinventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih K-Room:</h6>
                <div style="max-height: 250px; overflow-y: auto;">
                    @forelse ($kroomForSidebar as $kroom)
                        {{-- PERBAIKAN: Link diubah agar mengirim parameter filter --}}
                        <a class="collapse-item {{ request('kroom_id') == $kroom->id ? 'active' : '' }}" 
                           href="{{ route('kinventaris.index', ['kroom_id' => $kroom->id]) }}">
                            {{ $kroom->name }}
                        </a>
                    @empty
                        <span class="collapse-item">Belum ada data K-Room</span>
                    @endforelse
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

