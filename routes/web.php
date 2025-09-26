<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\RusakController;
use App\Http\Controllers\InventarisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

// Resource route untuk Ruangan
Route::resource('room', RoomController::class);

// =================================================================
// TAMBAHKAN RUTE CUSTOM UNTUK INVENTARIS DI SINI
// =================================================================

// Rute custom untuk mencetak PDF
Route::get('/inventaris/print', [InventarisController::class, 'printPDF'])->name('inventaris.print');

// Rute custom untuk memindahkan barang (dari pembahasan sebelumnya)
Route::put('/inventaris/{inventaris}/move', [InventarisController::class, 'move'])->name('inventaris.move');

// Resource route standar untuk CRUD inventaris (ini sudah ada)
// routes/web.php

Route::resource('inventaris', InventarisController::class)->parameters([
    'inventaris' => 'inventaris'
]);

Route::resource('tanah', TanahController::class);
Route::resource('gedung', GedungController::class);
Route::resource('peralatan', PeralatanController::class);
Route::resource('rusak', RusakController::class);