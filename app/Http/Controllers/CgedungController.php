<?php

namespace App\Http\Controllers;

use App\Models\Cgedung;
use Illuminate\Http\Request;

class CgedungController extends Controller
{
    public function index()
    {
        $cgedungItems = Cgedung::latest()->paginate(10);
        return view('pages.cgedung.index', compact('cgedungItems'));
    }

    public function create()
    {
        return view('pages.cgedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:cgedungs,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Cgedung::create($request->all());
        return redirect()->route('cgedung.index')->with('success', 'Data C-Gedung & Bangunan berhasil ditambahkan.');
    }

    public function edit(Cgedung $cgedung)
    {
        return view('pages.cgedung.edit', compact('cgedung'));
    }

    public function update(Request $request, Cgedung $cgedung)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:cgedungs,kode_barang,' . $cgedung->id,
            'harga' => 'required|numeric',
        ]);

        $cgedung->update($request->all());
        return redirect()->route('cgedung.index')->with('success', 'Data C-Gedung & Bangunan berhasil diperbarui.');
    }

    public function destroy(Cgedung $cgedung)
    {
        $cgedung->delete();
        return redirect()->route('cgedung.index')->with('success', 'Data C-Gedung & Bangunan berhasil dihapus.');
    }
}
