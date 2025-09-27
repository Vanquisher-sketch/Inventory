<?php

namespace App\Http\Controllers;

use App\Models\Kroom; // DIUBAH: Menggunakan model Kroom
use Illuminate\Http\Request;
use PDF; // Pastikan library PDF sudah terinstall

class KroomController extends Controller
{
    /**
     * Menampilkan daftar semua kroom.
     */
    public function index()
    {
        // DIUBAH: Mengambil data dari model Kroom
        $krooms = Kroom::latest()->get(); 
        
        // DIUBAH: Mengarahkan ke view kroom.index dan mengirim variabel $krooms
        return view('pages.kroom.index', [
            'krooms' => $krooms
        ]);
    }

    /**
     * Menampilkan form untuk membuat kroom baru.
     */
    public function create()
    {
        // DIUBAH: Mengarahkan ke view kroom.create
        return view('pages.kroom.create');
    }

    /**
     * Menyimpan data kroom baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // DIUBAH: Validasi unique pada tabel 'krooms'
            'kode_ruangan' => 'required|string|unique:krooms,kode_ruangan|max:255',
        ]);

        // 2. Simpan data ke database menggunakan model Kroom
        Kroom::create($validatedData);

        // 3. Alihkan (redirect) ke halaman index kroom dengan pesan sukses
        return redirect()->route('kroom.index')->with('success', 'Data K-Room baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data kroom.
     * Menggunakan Route Model Binding (Kroom $kroom)
     */
    public function edit(Kroom $kroom) // DIUBAH: Type-hinting ke model Kroom
    {
        // DIUBAH: Mengarahkan ke view kroom.edit dan mengirim variabel $kroom
        return view('pages.kroom.edit', [
            'kroom' => $kroom,
        ]);
    }
    
    /**
     * Memperbarui data kroom di database.
     * Menggunakan Route Model Binding (Kroom $kroom)
     */
    public function update(Request $request, Kroom $kroom) // DIUBAH: Type-hinting ke model Kroom
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // DIUBAH: Aturan unique disesuaikan untuk proses update
            'kode_ruangan' => 'required|string|max:255|unique:krooms,kode_ruangan,' . $kroom->id,
        ]);

        $kroom->update($validatedData);

        return redirect()->route('kroom.index')->with('success', 'Data K-Room berhasil diubah!');
    }
    
    /**
     * Menghapus data kroom dari database.
     * Menggunakan Route Model Binding (Kroom $kroom)
     */
    public function destroy(Kroom $kroom) // DIUBAH: Type-hinting ke model Kroom
    {
        $kroom->delete();

        return redirect()->route('kroom.index')->with('success', 'Data K-Room berhasil dihapus!');
    }

    /**
     * Membuat dan menampilkan laporan dalam format PDF.
     */
    public function printPDF()
    {
        // DIUBAH: Mengambil semua data dari model Kroom
        $krooms = Kroom::all(); 
        
        // DIUBAH: Mengarahkan ke view cetak untuk kroom
        $pdf = PDF::loadView('pages.kroom.cetak', [
            'krooms' => $krooms,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-data-kroom.pdf');
    }
}
