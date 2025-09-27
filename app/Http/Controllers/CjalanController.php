<?php

namespace App\Http\Controllers;

use App\Models\Cjalan;
use Illuminate\Http\Request;

class CjalanController extends Controller
{
    public function index()
    {
        $cjalanItems = Cjalan::latest()->paginate(15);
        return view('pages.cjalan.index', compact('cjalanItems'));
    }

    public function create()
    {
        return view('pages.cjalan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:cjalans,kode_barang',
        ]);

        Cjalan::create($request->all());
        return redirect()->route('cjalan.index')->with('success', 'Data C-Jalan, Irigasi & Jaringan berhasil ditambahkan.');
    }

    public function edit(Cjalan $cjalan)
    {
        return view('pages.cjalan.edit', compact('cjalan'));
    }

    public function update(Request $request, Cjalan $cjalan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:cjalans,kode_barang,' . $cjalan->id,
        ]);

        $cjalan->update($request->all());
        return redirect()->route('cjalan.index')->with('success', 'Data C-Jalan, Irigasi & Jaringan berhasil diperbarui.');
    }

    public function destroy(Cjalan $cjalan)
    {
        $cjalan->delete();
        return redirect()->route('cjalan.index')->with('success', 'Data C-Jalan, Irigasi & Jaringan berhasil dihapus.');
    }
}
