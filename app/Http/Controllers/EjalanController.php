<?php

namespace App\Http\Controllers;

use App\Models\Ejalan;
use Illuminate\Http\Request;

class EjalanController extends Controller
{
    public function index()
    {
        $ejalanItems = Ejalan::latest()->paginate(15);
        return view('pages.ejalan.index', compact('ejalanItems'));
    }

    public function create()
    {
        return view('pages.ejalan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:ejalans,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Ejalan::create($request->all());
        return redirect()->route('ejalan.index')->with('success', 'Data E-Jalan, Irigasi & Jaringan berhasil ditambahkan.');
    }

    public function edit(Ejalan $ejalan)
    {
        return view('pages.ejalan.edit', compact('ejalan'));
    }

    public function update(Request $request, Ejalan $ejalan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:ejalans,kode_barang,' . $ejalan->id,
            'harga' => 'required|numeric',
        ]);

        $ejalan->update($request->all());
        return redirect()->route('ejalan.index')->with('success', 'Data E-Jalan, Irigasi & Jaringan berhasil diperbarui.');
    }

    public function destroy(Ejalan $ejalan)
    {
        $ejalan->delete();
        return redirect()->route('ejalan.index')->with('success', 'Data E-Jalan, Irigasi & Jaringan berhasil dihapus.');
    }
}
