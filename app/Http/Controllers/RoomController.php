<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use PDF; // Pastikan library PDF sudah terinstall

class RoomController extends Controller
{
    /**
     * Menampilkan daftar semua ruangan.
     */
    public function index()
    {
        $rooms = Room::latest()->get(); // Mengambil data terbaru
        return view('pages.room.index', [
            'rooms' => $rooms
        ]);
    }

    /**
     * Menampilkan form untuk membuat ruangan baru.
     */
    public function create()
    {
        return view('pages.room.create');
    }

    /**
     * Menyimpan data ruangan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            // DIUBAH: dari 'code' menjadi 'kode_ruangan' agar cocok dengan form
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|unique:rooms,kode_ruangan|max:255',
        ]);

        // 2. Simpan data ke database
        Room::create($validatedData);

        // 3. Alihkan (redirect) dengan pesan sukses
        // PERBAIKAN: Menggunakan nama route lebih baik daripada URL statis
        return redirect()->route('room.index')->with('sukses', 'Ruangan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data ruangan.
     * PERBAIKAN: Menggunakan Route Model Binding (Room $room)
     * Laravel akan otomatis mencari Room berdasarkan ID, jika tidak ketemu akan menampilkan 404.
     */
    public function edit(Room $room)
    {
        return view('pages.room.edit', [
            'room' => $room,
        ]);
    }
    
    /**
     * Memperbarui data ruangan di database.
     * PERBAIKAN: Menggunakan Route Model Binding (Room $room)
     */
    public function update(Request $request, Room $room)
    {
        $validatedData = $request->validate([
            // DIUBAH: dari 'code' menjadi 'kode_ruangan'
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|max:255|unique:rooms,kode_ruangan,' . $room->id,
        ]);

        $room->update($validatedData);

        return redirect()->route('room.index')->with('sukses', 'Data ruangan berhasil diubah!');
    }
    
    /**
     * Menghapus data ruangan dari database.
     * PERBAIKAN: Menggunakan Route Model Binding (Room $room)
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('room.index')->with('sukses', 'Data ruangan berhasil dihapus!');
    }

    /**
     * Membuat dan menampilkan laporan dalam format PDF.
     */
    public function printPDF()
    {
        $rooms = Room::all(); 
        
        // Asumsi Anda punya kolom 'jumlah' di tabel, jika tidak, hapus 2 baris ini
        $total_jumlah = $rooms->sum('jumlah');

        $pdf = PDF::loadView('pages.room.cetak', [
            'rooms' => $rooms,
            'total_jumlah' => $total_jumlah
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-data-ruangan.pdf');
    }
}