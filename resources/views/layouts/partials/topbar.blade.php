<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Tombol Toggle Sidebar untuk Tampilan Mobile -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Global Search Bar -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari penduduk, fasilitas..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>


    <!-- Navbar Sebelah Kanan -->
    <ul class="navbar-nav ml-auto">

        <!-- Jam Real-time -->
        <li class="nav-item d-none d-lg-flex align-items-center">
             <div class="font-weight-bold text-gray-800 small">
                <i class="fas fa-calendar-alt fa-sm mr-2 text-gray-400"></i>
                <span id="live-date"></span> | <span id="live-time"></span>
            </div>
        </li>


    
        <div class="topbar-divider d-none d-sm-block"></div>

        @auth
        <!-- Informasi Pengguna -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->name }}
                    <br>
                    <small class="text-info font-weight-bold">{{ ucwords(strtolower(auth()->user()->getRoleNames()->first() ?? '')) }}</small>
                </span>
                <img class="img-profile rounded-circle"
                    src="{{ asset('template/img/undraw_profile.svg')}}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
        @endauth

    </ul>
</nav>

{{-- SCRIPT DAN STYLE INI SEBAIKNYA DIPINDAHKAN KE LAYOUT UTAMA (app.blade.php) --}}
<style>
    /* Animasi Ikon Navbar */
    .topbar .nav-item .nav-link {
        transition: transform 0.2s ease-in-out, background-color 0.2s;
    }
    .topbar .nav-item .nav-link:hover {
        transform: translateY(-2px);
        background-color: #f8f9fc;
    }
    .topbar .nav-item .nav-link:active {
        transform: translateY(0);
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // --- FUNGSI JAM REAL-TIME ---
    function updateClock() {
        const now = new Date();
        const dateEl = document.getElementById('live-date');
        const timeEl = document.getElementById('live-time');

        if(dateEl && timeEl) {
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateEl.textContent = now.toLocaleDateString('id-ID', dateOptions);
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', timeZoneName: 'short' };
            timeEl.textContent = now.toLocaleTimeString('id-ID', timeOptions);
        }
    }
    setInterval(updateClock, 1000);
    updateClock();

    // --- FUNGSI DARK MODE TOGGLE ---
    const themeToggleBtn = document.getElementById('theme-toggle-btn');
    if (themeToggleBtn) {
        const themeIcon = themeToggleBtn.querySelector('i');
        const body = document.body;
        const currentTheme = localStorage.getItem('theme');

        const updateIcon = () => {
            if (body.classList.contains('dark-mode')) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        };

        if (currentTheme) {
            body.classList.add(currentTheme);
            updateIcon();
        }

        themeToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.toggle('dark-mode');
            let theme = 'light';
            if (body.classList.contains('dark-mode')) {
                theme = 'dark-mode';
            }
            localStorage.setItem('theme', theme);
            updateIcon();
        });
    }
});
</script>

