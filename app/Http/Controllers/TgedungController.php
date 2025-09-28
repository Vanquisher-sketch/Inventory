<?php

namespace App\Http\Controllers;

use App\Models\Tgedung;
use Illuminate\Http\Request;

class TgedungController extends Controller
{
    public function index()
    {
        $tgedungItems = Tgedung::latest()->paginate(10);
        return view('pages.tgedung.index', compact('tgedungItems'));
    }

    public function create()
    {
        return view('pages.tgedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:tgedungs,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Tgedung::create($request->all());
        return redirect()->route('tgedung.index')->with('success', 'Data C-Gedung & Bangunan berhasil ditambahkan.');
    }

    public function edit(Tgedung $tgedung)
    {
        return view('pages.tgedung.edit', compact('tgedung'));
    }

    public function update(Request $request, Tgedung $tgedung)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:tgedungs,kode_barang,' . $tgedung->id,
            'harga' => 'required|numeric',
        ]);

        $tgedung->update($request->all());
        return redirect()->route('tgedung.index')->with('success', 'Data C-Gedung & Bangunan berhasil diperbarui.');
    }

    public function destroy(Tgedung $tgedung)
    {
        $tgedung->delete();
        return redirect()->route('tgedung.index')->with('success', 'Data C-Gedung & Bangunan berhasil dihapus.');
    }
}
