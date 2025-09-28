<?php

namespace App\Http\Controllers;

use App\Models\Lgedung;
use Illuminate\Http\Request;

class LgedungController extends Controller
{
    public function index()
    {
        $lgedungItems = Lgedung::latest()->paginate(10);
        return view('pages.lgedung.index', compact('lgedungItems'));
    }

    public function create()
    {
        return view('pages.lgedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:lgedungs,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Lgedung::create($request->all());
        return redirect()->route('lgedung.index')->with('success', 'Data Gedung & Bangunan berhasil ditambahkan.');
    }

    public function edit(lgedung $lgedung)
    {
        return view('pages.lgedung.edit', compact('lgedung'));
    }

    public function update(Request $request, lgedung $lgedung)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:lgedungs,kode_barang,' . $lgedung->id,
            'harga' => 'required|numeric',
        ]);

        $lgedung->update($request->all());
        return redirect()->route('lgedung.index')->with('success', 'Data Gedung & Bangunan berhasil diperbarui.');
    }

    public function destroy(lgedung $lgedung)
    {
        $lgedung->delete();
        return redirect()->route('lgedung.index')->with('success', 'Data Gedung & Bangunan berhasil dihapus.');
    }
}