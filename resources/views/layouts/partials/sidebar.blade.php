@php
    // Query untuk daftar ruangan di menu shortcut
    $roomForSidebar = \App\Models\Room::orderBy('name', 'asc')->get();
    $kroomForSidebar = \App\Models\Kroom::orderBy('name', 'asc')->get();
    $croomForSidebar = \App\Models\Croom::orderBy('name', 'asc')->get();
    $eroomForSidebar = \App\Models\Eroom::orderBy('name', 'asc')->get();
    $lroomForSidebar = \App\Models\Lroom::orderBy('name', 'asc')->get();
    $troomForSidebar = \App\Models\Troom::orderBy('name', 'asc')->get();

    // Logika state aktif untuk menu TAWANG
    $isAssetMenuActive = request()->is('room*') || request()->is('tanah*') || request()->is('gedung*') || request()->is('peralatan*') || request()->is('jalan*') || request()->is('rusak*');
    $isInventarisMenuActive = request()->is('inventaris*');

    // Logika state aktif untuk menu K-ROOM
    $isKroomAssetMenuActive = request()->is('kroom*') || request()->is('ktanah*') || request()->is('kgedung*') || request()->is('kperalatan*') || request()->is('kjalan*') || request()->is('krusak*');
    $isKinventarisMenuActive = request()->is('kinventaris*');

    // Logika state aktif untuk menu C-ROOM
    $isCroomAssetMenuActive = request()->is('croom*') || request()->is('ctanah*') || request()->is('cgedung*') || request()->is('cperalatan*') || request()->is('cjalan*') || request()->is('crusak*');
    $isCinventarisMenuActive = request()->is('cinventaris*');

    // Logika state aktif untuk menu E-ROOM
    $isEroomAssetMenuActive = request()->is('eroom*') || request()->is('etanah*') || request()->is('egedung*') || request()->is('eperalatan*') || request()->is('ejalan*') || request()->is('erusak*');
    $isEinventarisMenuActive = request()->is('einventaris*');

    // Logika state aktif untuk menu L-ROOM
    $isLroomAssetMenuActive = request()->is('lroom*') || request()->is('ltanah*') || request()->is('lgedung*') || request()->is('lperalatan*') || request()->is('ljalan*') || request()->is('lrusak*');
    $isLinventarisMenuActive = request()->is('linventaris*');

    // Logika state aktif untuk menu T-ROOM
    $isTroomAssetMenuActive = request()->is('troom*') || request()->is('ttanah*') || request()->is('tgedung*') || request()->is('tperalatan*') || request()->is('tjalan*') || request()->is('trusak*');
    $isTinventarisMenuActive = request()->is('tinventaris*');
@endphp

{{-- CSS FIX UNTUK SIDEBAR SCROLLING --}}
<style>
    #accordionSidebar {
        overflow-y: auto;
        overflow-x: hidden;
    }
    #accordionSidebar::-webkit-scrollbar { width: 8px; }
    #accordionSidebar::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.1); }
    #accordionSidebar::-webkit-scrollbar-thumb { background: #858796; border-radius: 4px; }
    #accordionSidebar::-webkit-scrollbar-thumb:hover { background: #5a5c69; }
</style>

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
        Kecamatan Tawang
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
                <a class="collapse-item {{ request()->is('tanah*') ? 'active' : '' }}" href="{{ route('tanah.index') }}"> - Tanah</a>
                <a class="collapse-item {{ request()->is('peralatan*') ? 'active' : '' }}" href="{{ route('peralatan.index') }}">- Peralatan</a>
                <a class="collapse-item {{ request()->is('gedung*') ? 'active' : '' }}" href="{{ route('gedung.index') }}">- Gedung</a>
                <a class="collapse-item {{ request()->is('jalan*') ? 'active' : '' }}" href="{{ route('jalan.index') }}">- Jalan & Jaringan</a>
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

    <!-- HEADING DAN MENU UNTUK KAHURIPAN -->
    <div class="sidebar-heading">
        Kelurahan Kahuripan
    </div>

    <!-- Nav Item - Manajemen Aset K-Room -->
    <li class="nav-item {{ $isKroomAssetMenuActive && !$isKinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKroomAset" aria-expanded="true" aria-controls="collapseKroomAset">
            <i class="fas fa-fw fa-building"></i>
            <span>Manajemen Aset</span>
        </a>
        <div id="collapseKroomAset" class="collapse {{ $isKroomAssetMenuActive && !$isKinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingKroomAset" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('kroom*') ? 'active' : '' }}" href="{{ route('kroom.index') }}">Daftar K-Room</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Kartu Inventaris Barang:</h6>
                <a class="collapse-item {{ request()->is('ktanah*') ? 'active' : '' }}" href="{{ route('ktanah.index') }}"> - K-Tanah</a>
                <a class="collapse-item {{ request()->is('kperalatan*') ? 'active' : '' }}" href="{{ route('kperalatan.index') }}">- K-Peralatan</a>
                <a class="collapse-item {{ request()->is('kgedung*') ? 'active' : '' }}" href="{{ route('kgedung.index') }}">- K-Gedung</a>
                <a class="collapse-item {{ request()->is('kjalan*') ? 'active' : '' }}" href="{{ route('kjalan.index') }}">- K-Jalan</a>
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
    <hr class="sidebar-divider">

    <!-- HEADING DAN MENU BARU UNTUK CIHIDEUNG -->
    <div class="sidebar-heading">
        Kelurahan Cikalang
    </div>

    <!-- Nav Item - Manajemen Aset C-Room -->
    <li class="nav-item {{ $isCroomAssetMenuActive && !$isCinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCroomAset" aria-expanded="true" aria-controls="collapseCroomAset">
            <i class="fas fa-fw fa-university"></i>
            <span>Manajemen Aset</span>
        </a>
        <div id="collapseCroomAset" class="collapse {{ $isCroomAssetMenuActive && !$isCinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingCroomAset" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('croom*') ? 'active' : '' }}" href="{{ route('croom.index') }}">Daftar C-Room</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Kartu Inventaris Barang:</h6>
                <a class="collapse-item {{ request()->is('ctanah*') ? 'active' : '' }}" href="{{ route('ctanah.index') }}"> - C-Tanah</a>
                <a class="collapse-item {{ request()->is('cperalatan*') ? 'active' : '' }}" href="{{ route('cperalatan.index') }}">- C-Peralatan</a>
                <a class="collapse-item {{ request()->is('cgedung*') ? 'active' : '' }}" href="{{ route('cgedung.index') }}">- C-Gedung</a>
                <a class="collapse-item {{ request()->is('cjalan*') ? 'active' : '' }}" href="{{ route('cjalan.index') }}">- C-Jalan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan Kondisi:</h6>
                <a class="collapse-item {{ request()->is('crusak*') ? 'active' : '' }}" href="{{ route('crusak.index') }}">C-Barang Rusak</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - C-Inventaris Ruangan -->
    <li class="nav-item {{ $isCinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCinventaris" aria-expanded="true" aria-controls="collapseCinventaris">
            <i class="fas fa-fw fa-boxes"></i>
            <span>C-Inventaris</span>
        </a>
        <div id="collapseCinventaris" class="collapse {{ $isCinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingCinventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih C-Room:</h6>
                <div style="max-height: 250px; overflow-y: auto;">
                    @forelse ($croomForSidebar as $croom)
                        <a class="collapse-item {{ request('croom_id') == $croom->id ? 'active' : '' }}" 
                           href="{{ route('cinventaris.index', ['croom_id' => $croom->id]) }}">
                            {{ $croom->name }}
                        </a>
                    @empty
                        <span class="collapse-item">Belum ada data C-Room</span>
                    @endforelse
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- HEADING DAN MENU BARU UNTUK EMPANGSARI -->
    <div class="sidebar-heading">
        Kelurahan Empangsari
    </div>
    <li class="nav-item {{ $isEroomAssetMenuActive && !$isEinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEroomAset" aria-expanded="true" aria-controls="collapseEroomAset">
            <i class="fas fa-fw fa-landmark"></i>
            <span>Manajemen Aset</span>
        </a>
        <div id="collapseEroomAset" class="collapse {{ $isEroomAssetMenuActive && !$isEinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingEroomAset" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('eroom*') ? 'active' : '' }}" href="{{ route('eroom.index') }}">Daftar E-Room</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Kartu Inventaris Barang:</h6>
                <a class="collapse-item {{ request()->is('etanah*') ? 'active' : '' }}" href="{{ route('etanah.index') }}"> - E-Tanah</a>
                <a class="collapse-item {{ request()->is('eperalatan*') ? 'active' : '' }}" href="{{ route('eperalatan.index') }}">- E-Peralatan</a>
                <a class="collapse-item {{ request()->is('egedung*') ? 'active' : '' }}" href="{{ route('egedung.index') }}">- E-Gedung</a>
                <a class="collapse-item {{ request()->is('ejalan*') ? 'active' : '' }}" href="{{ route('ejalan.index') }}">- E-Jalan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan Kondisi:</h6>
                <a class="collapse-item {{ request()->is('erusak*') ? 'active' : '' }}" href="{{ route('erusak.index') }}">E-Barang Rusak</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ $isEinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEinventaris" aria-expanded="true" aria-controls="collapseEinventaris">
            <i class="fas fa-fw fa-dolly-flatbed"></i>
            <span>E-Inventaris</span>
        </a>
        <div id="collapseEinventaris" class="collapse {{ $isEinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingEinventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih E-Room:</h6>
                <div style="max-height: 250px; overflow-y: auto;">
                    @forelse ($eroomForSidebar as $eroom)
                        <a class="collapse-item {{ request('eroom_id') == $eroom->id ? 'active' : '' }}" 
                           href="{{ route('einventaris.index', ['eroom_id' => $eroom->id]) }}">
                            {{ $eroom->name }}
                        </a>
                    @empty
                        <span class="collapse-item">Belum ada data E-Room</span>
                    @endforelse
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- HEADING DAN MENU BARU UNTUK LENGKONGSARI -->
    <div class="sidebar-heading">
        Kelurahan Lengkongsari
    </div>
    <li class="nav-item {{ $isLroomAssetMenuActive && !$isLinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLroomAset" aria-expanded="true" aria-controls="collapseLroomAset">
            <i class="fas fa-fw fa-store"></i>
            <span>Manajemen Aset</span>
        </a>
        <div id="collapseLroomAset" class="collapse {{ $isLroomAssetMenuActive && !$isLinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingLroomAset" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('lroom*') ? 'active' : '' }}" href="{{ route('lroom.index') }}">Daftar L-Room</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Kartu Inventaris Barang:</h6>
                <a class="collapse-item {{ request()->is('ltanah*') ? 'active' : '' }}" href="{{ route('ltanah.index') }}"> - L-Tanah</a>
                <a class="collapse-item {{ request()->is('lperalatan*') ? 'active' : '' }}" href="{{ route('lperalatan.index') }}">- L-Peralatan</a>
                <a class="collapse-item {{ request()->is('lgedung*') ? 'active' : '' }}" href="{{ route('lgedung.index') }}">- L-Gedung</a>
                <a class="collapse-item {{ request()->is('ljalan*') ? 'active' : '' }}" href="{{ route('ljalan.index') }}">- L-Jalan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan Kondisi:</h6>
                <a class="collapse-item {{ request()->is('lrusak*') ? 'active' : '' }}" href="{{ route('lrusak.index') }}">L-Barang Rusak</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ $isLinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLinventaris" aria-expanded="true" aria-controls="collapseLinventaris">
            <i class="fas fa-fw fa-people-carry"></i>
            <span>L-Inventaris</span>
        </a>
        <div id="collapseLinventaris" class="collapse {{ $isLinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingLinventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih L-Room:</h6>
                <div style="max-height: 250px; overflow-y: auto;">
                    @forelse ($lroomForSidebar as $lroom)
                        <a class="collapse-item {{ request('lroom_id') == $lroom->id ? 'active' : '' }}" 
                           href="{{ route('linventaris.index', ['lroom_id' => $lroom->id]) }}">
                            {{ $lroom->name }}
                        </a>
                    @empty
                        <span class="collapse-item">Belum ada data L-Room</span>
                    @endforelse
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- HEADING DAN MENU BARU UNTUK TAWANGSARI -->
    <div class="sidebar-heading">
        Kelurahan Tawangsari
    </div>
    <li class="nav-item {{ $isTroomAssetMenuActive && !$isTinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTroomAset" aria-expanded="true" aria-controls="collapseTroomAset">
            <i class="fas fa-fw fa-school"></i>
            <span>Manajemen Aset</span>
        </a>
        <div id="collapseTroomAset" class="collapse {{ $isTroomAssetMenuActive && !$isTinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingTroomAset" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('troom*') ? 'active' : '' }}" href="{{ route('troom.index') }}">Daftar T-Room</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Kartu Inventaris Barang:</h6>
                <a class="collapse-item {{ request()->is('ttanah*') ? 'active' : '' }}" href="{{ route('ttanah.index') }}"> - T-Tanah</a>
                <a class="collapse-item {{ request()->is('tperalatan*') ? 'active' : '' }}" href="{{ route('tperalatan.index') }}">- T-Peralatan</a>
                <a class="collapse-item {{ request()->is('tgedung*') ? 'active' : '' }}" href="{{ route('tgedung.index') }}">- T-Gedung</a>
                <a class="collapse-item {{ request()->is('tjalan*') ? 'active' : '' }}" href="{{ route('tjalan.index') }}">- T-Jalan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan Kondisi:</h6>
                <a class="collapse-item {{ request()->is('trusak*') ? 'active' : '' }}" href="{{ route('trusak.index') }}">T-Barang Rusak</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ $isTinventarisMenuActive ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTinventaris" aria-expanded="true" aria-controls="collapseTinventaris">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>T-Inventaris</span>
        </a>
        <div id="collapseTinventaris" class="collapse {{ $isTinventarisMenuActive ? 'show' : '' }}" aria-labelledby="headingTinventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih T-Room:</h6>
                <div style="max-height: 250px; overflow-y: auto;">
                    @forelse ($troomForSidebar as $troom)
                        <a class="collapse-item {{ request('troom_id') == $troom->id ? 'active' : '' }}" 
                           href="{{ route('tinventaris.index', ['troom_id' => $troom->id]) }}">
                            {{ $troom->name }}
                        </a>
                    @empty
                        <span class="collapse-item">Belum ada data T-Room</span>
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

