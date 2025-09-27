<?php

// Kecamatan Tawang
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\JalanController;
use App\Http\Controllers\RusakController;
use App\Http\Controllers\InventarisController;
// Kahuripan
use App\Http\Controllers\KroomController;
use App\Http\Controllers\KinventarisController;
use App\Http\Controllers\KtanahController;
use App\Http\Controllers\KgedungController;
use App\Http\Controllers\KperalatanController;
use App\Http\Controllers\KjalanController;
use App\Http\Controllers\KrusakController;
// Cikalang
use App\Http\Controllers\CroomController;
use App\Http\Controllers\CinventarisController;
use App\Http\Controllers\CtanahController;
use App\Http\Controllers\CgedungController;
use App\Http\Controllers\CperalatanController;
use App\Http\Controllers\CjalanController;
use App\Http\Controllers\CrusakController;
// Empangsari
use App\Http\Controllers\EroomController;
use App\Http\Controllers\EinventarisController;
use App\Http\Controllers\EtanahController;
use App\Http\Controllers\EgedungController;
use App\Http\Controllers\EperalatanController;
use App\Http\Controllers\EjalanController;
use App\Http\Controllers\ErusakController;
//Lengkongsari
use App\Http\Controllers\LroomController;
use App\Http\Controllers\LinventarisController;
use App\Http\Controllers\LtanahController;
use App\Http\Controllers\LgedungController;
use App\Http\Controllers\LperalatanController;
use App\Http\Controllers\LjalanController;
use App\Http\Controllers\LrusakController;
// Tawangsari
use App\Http\Controllers\TroomController;
use App\Http\Controllers\TinventarisController;
use App\Http\Controllers\TtanahController;
use App\Http\Controllers\TgedungController;
use App\Http\Controllers\TperalatanController;
use App\Http\Controllers\TjalanController;
use App\Http\Controllers\TrusakController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

// Resource route untuk Ruangan

// =================================================================
// TAMBAHKAN RUTE CUSTOM UNTUK INVENTARIS DI SINI
// =================================================================

// Rute custom untuk mencetak PDF
Route::get('/inventaris/print', [InventarisController::class, 'printPDF'])->name('inventaris.print');

// Rute custom untuk memindahkan barang (dari pembahasan sebelumnya)
Route::put('/inventaris/{inventaris}/move', [InventarisController::class, 'move'])->name('inventaris.move');

// Resource route standar untuk CRUD inventaris (ini sudah ada)
// routes/web.php

// Untuk Kecamatan Tawang
Route::resource('room', RoomController::class);
Route::resource('inventaris', InventarisController::class)->parameters([
    'inventaris' => 'inventaris'
]);
Route::resource('tanah', TanahController::class);
Route::resource('gedung', GedungController::class);
Route::resource('peralatan', PeralatanController::class);
Route::resource('rusak', RusakController::class);
Route::resource('jalan', JalanController::class);

// Untuk Kahuripan

// Rute custom untuk mencetak PDF
Route::get('/kinventaris/print', [KinventarisController::class, 'printPDF'])->name('kinventaris.print');

// Rute custom untuk memindahkan barang (dari pembahasan sebelumnya)
Route::put('/kinventaris/{kinventaris}/move', [KinventarisController::class, 'move'])->name('kinventaris.move');

// Resource route standar untuk CRUD kinventaris (ini sudah ada)
// routes/web.php

// Untuk Kecamatan Tawang
Route::resource('kroom', KroomController::class);
Route::resource('kinventaris', KinventarisController::class)->parameters([
    'kinventaris' => 'kinventaris'
]);
Route::resource('ktanah', KtanahController::class);
Route::resource('kgedung', KgedungController::class);
Route::resource('kperalatan', KperalatanController::class);
Route::resource('krusak', KrusakController::class);
Route::resource('kjalan', KjalanController::class);

// Untuk 

// Rute custom untuk mencetak PDF
Route::get('/cinventaris/print', [CinventarisController::class, 'printPDF'])->name('cinventaris.print');

// Rute custom untuk memindahkan barang (dari pembahasan sebelumnya)
Route::put('/cinventaris/{cinventaris}/move', [CinventarisController::class, 'move'])->name('cinventaris.move');

// Resource route standar untuk CRUD cinventaris (ini sudah ada)
// routes/web.php

// Untuk Kecamatan Tawang
Route::resource('croom', CroomController::class);
Route::resource('cinventaris', CinventarisController::class)->parameters([
    'cinventaris' => 'cinventaris'
]);
Route::resource('ctanah', CtanahController::class);
Route::resource('cgedung', CgedungController::class);
Route::resource('cperalatan', CperalatanController::class);
Route::resource('crusak', CrusakController::class);
Route::resource('cjalan', CjalanController::class);

// Untuk Empangsari

// Rute custom untuk mencetak PDF
Route::get('/einventaris/print', [EinventarisController::class, 'printPDF'])->name('einventaris.print');

// Rute custom untuk memindahkan barang (dari pembahasan sebelumnya)
Route::put('/einventaris/{einventaris}/move', [EinventarisController::class, 'move'])->name('einventaris.move');

// Resource route standar untuk CRUD einventaris (ini sudah ada)
// routes/web.php

// Untuk Kecamatan Tawang
Route::resource('kroom', EroomController::class);
Route::resource('einventaris', EinventarisController::class)->parameters([
    'einventaris' => 'einventaris'
]);
Route::resource('etanah', EtanahController::class);
Route::resource('egedung', EgedungController::class);
Route::resource('eperalatan', EperalatanController::class);
Route::resource('erusak', ErusakController::class);
Route::resource('ejalan', EalanController::class);

// Untuk Lengkongsari

// Rute custom untuk mencetak PDF
Route::get('/linventaris/print', [LinventarisController::class, 'printPDF'])->name('linventaris.print');

// Rute custom untuk memindahkan barang (dari pembahasan sebelumnya)
Route::put('/linventaris/{linventaris}/move', [LinventarisController::class, 'move'])->name('linventaris.move');

// Resource route standar untuk CRUD linventaris (ini sudah ada)
// routes/web.php

// Untuk Kecamatan Tawang
Route::resource('lroom', LroomController::class);
Route::resource('linventaris', LinventarisController::class)->parameters([
    'linventaris' => 'linventaris'
]);
Route::resource('ltanah', LtanahController::class);
Route::resource('lgedung', LgedungController::class);
Route::resource('lperalatan', LperalatanController::class);
Route::resource('lrusak', LrusakController::class);
Route::resource('ljalan', LjalanController::class);

// Untuk Tawangsari

// Rute custom untuk mencetak PDF
Route::get('/tinventaris/print', [TinventarisController::class, 'printPDF'])->name('tinventaris.print');

// Rute custom untuk memindahkan barang (dari pembahasan sebelumnya)
Route::put('/tinventaris/{tinventaris}/move', [TinventarisController::class, 'move'])->name('tinventaris.move');

// Resource route standar untuk CRUD tinventaris (ini sudah ada)
// routes/web.php

// Untuk Kecamatan Tawang
Route::resource('troom', TroomController::class);
Route::resource('tinventaris', TinventarisController::class)->parameters([
    'tinventaris' => 'tinventaris'
]);
Route::resource('ttanah', TtanahController::class);
Route::resource('tgedung', TgedungController::class);
Route::resource('tperalatan', peralatanController::class);
Route::resource('trusak', TrusakController::class);
Route::resource('tjalan', TjalanController::class);