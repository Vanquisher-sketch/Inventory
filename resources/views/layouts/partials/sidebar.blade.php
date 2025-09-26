@php
    // Query ini mengambil data ruangan untuk ditampilkan di sidebar.
    // Nanti, pindahkan ini ke AppServiceProvider agar lebih rapi.
    $roomForSidebar = \App\Models\Room::orderBy('name', 'asc')->get();
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
        Manajemen Data
    </div>

    <li class="nav-item {{ request()->is('room*') || request()->is('inventaris*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoom"
            aria-expanded="true" aria-controls="collapseRoom">
            <i class="fas fa-fw fa-door-open"></i>
            <span>Manajemen Ruangan</span>
        </a>
        
        <div id="collapseRoom" class="collapse {{ request()->is('room*') || request()->is('inventaris*') ? 'show' : '' }}" aria-labelledby="headingRoom" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opsi Ruangan:</h6>
                <a class="collapse-item {{ request()->routeIs('room.index') ? 'active' : '' }}" href="{{ route('room.index') }}">
                    <i class="fas fa-list-ul fa-fw mr-2 text-gray-400"></i>
                    Daftar Ruangan
                </a>
                <a class="collapse-item {{ request()->routeIs('room.create') ? 'active' : '' }}" href="{{ route('room.create') }}">
                    <i class="fas fa-plus-square fa-fw mr-2 text-gray-400"></i>
                    Tambah Ruangan
                </a>

                @if($roomForSidebar->count() > 0)
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Inventaris per Ruangan:</h6>
                    <div style="max-height: 250px; overflow-y: auto;">
                        @foreach ($roomForSidebar as $room)
                            <a class="collapse-item {{ request()->is('room/*/inventaris*') && request()->route('room')->id == $room->id ? 'active' : '' }}" 
                               href="{{ route('inventaris.index', $room->id) }}">
                                <i class="fas fa-angle-right fa-fw mr-2 text-gray-400"></i>
                                {{ $room->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </li>

    {{-- ============================================= --}}
    {{-- NAV ITEM - DATA BARANG (DROPDOWN BARU) --}}
    {{-- ============================================= --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang"
            aria-expanded="true" aria-controls="collapseBarang">
            <i class="fas fa-fw fa-archive"></i>
            <span>Data Barang</span>
        </a>
        
        <div id="collapseBarang" class="collapse" aria-labelledby="headingBarang" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kategori Aset:</h6>
                {{-- PENTING: href="#" masih placeholder, perlu Anda ganti nanti --}}
                <a class="collapse-item {{ request()->routeIs('tanah.*') ? 'active' : '' }}" href="{{ route('tanah.index') }}">
                    <i class="fas fa-layer-group fa-fw mr-2 text-gray-400"></i>
                    Tanah
                </a>
                <a class="collapse-item" href="#">
                    <i class="fas fa-building fa-fw mr-2 text-gray-400"></i>
                    Gedung & Bangunan
                </a>
                <a class="collapse-item" href="#">
                    <i class="fas fa-tools fa-fw mr-2 text-gray-400"></i>
                    Peralatan
                </a>
                <a class="collapse-item" href="#">
                    <i class="fas fa-heart-broken fa-fw mr-2 text-gray-400"></i>
                    Rusak Berat
                </a>
            </div>
        </div>
    </li>


    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>