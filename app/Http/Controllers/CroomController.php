<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CroomController extends Controller
{
    /**
     * Menampilkan daftar semua croom.
     */
    public function index()
    {
        // DIUBAH: Mengambil data dari model croom
        $crooms = Croom::latest()->get(); 
        
        // DIUBAH: Mengarahkan ke view croom.index dan mengirim variabel $crooms
        return view('pages.croom.index', [
            'crooms' => $crooms
        ]);
    }

    /**
     * Menampilkan form untuk membuat croom baru.
     */
    public function create()
    {
        // DIUBAH: Mengarahkan ke view croom.create
        return view('pages.croom.create');
    }

    /**
     * Menyimpan data croom baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // DIUBAH: Validasi unique pada tabel 'crooms'
            'kode_ruangan' => 'required|string|unique:crooms,kode_ruangan|max:255',
        ]);

        // 2. Simpan data ke database menggunakan model croom
        Croom::create($validatedData);

        // 3. Alihkan (redirect) ke halaman index croom dengan pesan sukses
        return redirect()->route('croom.index')->with('success', 'Data K-Room baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data croom.
     * Menggunakan Route Model Binding (Croom $croom)
     */
    public function edit(Croom $croom) // DIUBAH: Type-hinting ke model croom
    {
        // DIUBAH: Mengarahkan ke view croom.edit dan mengirim variabel $croom
        return view('pages.croom.edit', [
            'croom' => $croom,
        ]);
    }
    
    /**
     * Memperbarui data croom di database.
     * Menggunakan Route Model Binding (Croom $croom)
     */
    public function update(Request $request, Croom $croom) // DIUBAH: Type-hinting ke model croom
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // DIUBAH: Aturan unique disesuaikan untuk proses update
            'kode_ruangan' => 'required|string|max:255|unique:crooms,kode_ruangan,' . $croom->id,
        ]);

        $croom->update($validatedData);

        return redirect()->route('croom.index')->with('success', 'Data K-Room berhasil diubah!');
    }
    
    /**
     * Menghapus data croom dari database.
     * Menggunakan Route Model Binding (Croom $croom)
     */
    public function destroy(Croom $croom) // DIUBAH: Type-hinting ke model croom
    {
        $croom->delete();

        return redirect()->route('croom.index')->with('success', 'Data K-Room berhasil dihapus!');
    }

    /**
     * Membuat dan menampilkan laporan dalam format PDF.
     */
    public function printPDF()
    {
        // DIUBAH: Mengambil semua data dari model croom
        $crooms = Croom::all(); 
        
        // DIUBAH: Mengarahkan ke view cetak untuk croom
        $pdf = PDF::loadView('pages.croom.cetak', [
            'crooms' => $crooms,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-data-croom.pdf');
    }
}