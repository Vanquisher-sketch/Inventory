<?php

namespace App\Http\Controllers;

use App\Models\Kgedung;
use Illuminate\Http\Request;

class KgedungController extends Controller
{
    public function index()
    {
        $kgedungItems = Kgedung::latest()->paginate(10);
        return view('pages.kgedung.index', compact('kgedungItems'));
    }

    public function create()
    {
        return view('pages.kgedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:kgedungs,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Kgedung::create($request->all());
        return redirect()->route('kgedung.index')->with('success', 'Data K-Gedung & Bangunan berhasil ditambahkan.');
    }

    public function show(Kgedung $kgedung)
    {
        return view('pages.kgedung.show', compact('kgedung'));
    }

    public function edit(Kgedung $kgedung)
    {
        return view('pages.kgedung.edit', compact('kgedung'));
    }

    public function update(Request $request, Kgedung $kgedung)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:kgedungs,kode_barang,' . $kgedung->id,
            'harga' => 'required|numeric',
        ]);

        $kgedung->update($request->all());
        return redirect()->route('kgedung.index')->with('success', 'Data K-Gedung & Bangunan berhasil diperbarui.');
    }

    public function destroy(Kgedung $kgedung)
    {
        $kgedung->delete();
        return redirect()->route('kgedung.index')->with('success', 'Data K-Gedung & Bangunan berhasil dihapus.');
    }
}
