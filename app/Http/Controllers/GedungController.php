<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedungItems = Gedung::latest()->paginate(10);
        return view('pages.gedung.index', compact('gedungItems'));
    }

    public function create()
    {
        return view('pages.gedung.create');
    }

    public function store(Request $request)
    {
        // Validasi lengkap sesuai kolom di KIB C
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'kode_barang'       => 'required|string|unique:gedungs,kode_barang',
            'register'          => 'required|string|max:255',
            'kondisi'           => 'required|string|in:B,KB,RB',
            'luas_lantai'       => 'required|integer|min:0',
            'letak'             => 'required|string',
            'dokumen_tanggal'   => 'nullable|date',
            'dokumen_nomor'     => 'nullable|string|max:255',
            'luas_tanah'        => 'required|integer|min:0',
            'status_tanah'      => 'nullable|string|max:255',
            'kode_tanah'        => 'nullable|string|max:255',
            'asal_usul'         => 'required|string|max:255',
            'harga'             => 'required|numeric|min:0',
            'keterangan'        => 'nullable|string',
        ]);

        // Menambahkan penanganan untuk checkbox
        $validatedData['bertingkat'] = $request->has('bertingkat'); // true jika dicentang, false jika tidak
        $validatedData['beton'] = $request->has('beton'); // true jika dicentang, false jika tidak

        Gedung::create($validatedData);
        return redirect()->route('gedung.index')->with('success', 'Data Gedung & Bangunan berhasil ditambahkan.');
    }

    public function show(Gedung $gedung)
    {
        return view('pages.gedung.show', compact('gedung'));
    }

    public function edit(Gedung $gedung)
    {
        return view('pages.gedung.edit', compact('gedung'));
    }

    public function update(Request $request, Gedung $gedung)
    {
        // Validasi lengkap untuk proses update
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'kode_barang'       => 'required|string|unique:gedungs,kode_barang,' . $gedung->id,
            'register'          => 'required|string|max:255',
            'kondisi'           => 'required|string|in:B,KB,RB',
            'luas_lantai'       => 'required|integer|min:0',
            'letak'             => 'required|string',
            'dokumen_tanggal'   => 'nullable|date',
            'dokumen_nomor'     => 'nullable|string|max:255',
            'luas_tanah'        => 'required|integer|min:0',
            'status_tanah'      => 'nullable|string|max:255',
            'kode_tanah'        => 'nullable|string|max:255',
            'asal_usul'         => 'required|string|max:255',
            'harga'             => 'required|numeric|min:0',
            'keterangan'        => 'nullable|string',
        ]);

        // Menambahkan penanganan untuk checkbox
        $validatedData['bertingkat'] = $request->has('bertingkat');
        $validatedData['beton'] = $request->has('beton');

        $gedung->update($validatedData);
        return redirect()->route('gedung.index')->with('success', 'Data Gedung & Bangunan berhasil diperbarui.');
    }

    public function destroy(Gedung $gedung)
    {
        $gedung->delete();
        return redirect()->route('gedung.index')->with('success', 'Data Gedung & Bangunan berhasil dihapus.');
    }
}