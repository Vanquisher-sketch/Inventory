<?php

namespace App\Http\Controllers;

use App\Models\Egedung;
use Illuminate\Http\Request;

class EgedungController extends Controller
{
    public function index()
    {
        $egedungItems = Egedung::latest()->paginate(10);
        return view('pages.egedung.index', compact('egedungItems'));
    }

    public function create()
    {
        return view('pages.egedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:egedungs,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Egedung::create($request->all());
        return redirect()->route('egedung.index')->with('success', 'Data Gedung & Bangunan berhasil ditambahkan.');
    }

    public function edit(Egedung $egedung)
    {
        return view('pages.egedung.edit', compact('egedung'));
    }

    public function update(Request $request, Egedung $egedung)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:egedungs,kode_barang,' . $egedung->id,
            'harga' => 'required|numeric',
        ]);

        $egedung->update($request->all());
        return redirect()->route('egedung.index')->with('success', 'Data Gedung & Bangunan berhasil diperbarui.');
    }

    public function destroy(Egedung $egedung)
    {
        $egedung->delete();
        return redirect()->route('egedung.index')->with('success', 'Data Gedung & Bangunan berhasil dihapus.');
    }
}
