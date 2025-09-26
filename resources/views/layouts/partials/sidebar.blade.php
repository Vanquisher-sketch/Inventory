@php
    // Query ini hanya dijalankan satu kali di sini.
    // Nanti, pindahkan ini ke AppServiceProvider agar lebih rapi.
    $roomsForSidebar = \App\Models\Room::orderBy('name', 'asc')->get();
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

    {{-- PERBAIKAN: Menggabungkan semua menu ruangan menjadi satu dropdown --}}
    <li class="nav-item {{ request()->is('room*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRooms"
            aria-expanded="true" aria-controls="collapseRooms">
            <i class="fas fa-fw fa-door-open"></i>
            <span>Manajemen Ruangan</span>
        </a>
        
        {{-- Logika 'show' agar dropdown otomatis terbuka jika sedang di halaman ruangan --}}
        <div id="collapseRooms" class="collapse {{ request()->is('room*') ? 'show' : '' }}" aria-labelledby="headingRooms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opsi Ruangan:</h6>
                
                {{-- Link statis untuk melihat semua ruangan --}}
                <a class="collapse-item" href="{{ route('room.index') }}">Daftar Semua Ruangan</a>
                
                {{-- Link statis untuk menambah ruangan baru --}}
                <a class="collapse-item" href="{{ route('room.create') }}">Tambah Ruangan Baru</a>

                {{-- PERBAIKAN: Tambahkan pemisah jika ada data ruangan --}}
                @if($roomsForSidebar->count() > 0)
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Akses Cepat:</h6>
                    
                    {{-- Loop untuk menampilkan setiap ruangan sebagai submenu --}}
                    @foreach ($roomsForSidebar as $room)
                        <a class="collapse-item" href="{{ route('room.show', $room->id) }}">{{ $room->name }}</a>
                    @endforeach
                @endif
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>