<?php

namespace App\Http\Controllers;

use App\Models\Cperalatan;
use Illuminate\Http\Request;

class CperalatanController extends Controller
{
    public function index()
    {
        $cperalatanItems = Cperalatan::latest()->paginate(15);
        return view('pages.cperalatan.index', compact('cperalatanItems'));
    }

    public function create()
    {
        return view('pages.cperalatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:cperalatans,kode_barang',
        ]);

        Cperalatan::create($request->all());
        return redirect()->route('cperalatan.index')->with('success', 'Data C-Peralatan & Mesin berhasil ditambahkan.');
    }

    public function edit(Cperalatan $cperalatan)
    {
        return view('pages.cperalatan.edit', compact('cperalatan'));
    }

    public function update(Request $request, Cperalatan $cperalatan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:cperalatans,kode_barang,' . $cperalatan->id,
        ]);

        $cperalatan->update($request->all());
        return redirect()->route('cperalatan.index')->with('success', 'Data C-Peralatan & Mesin berhasil diperbarui.');
    }

    public function destroy(Cperalatan $cperalatan)
    {
        $cperalatan->delete();
        return redirect()->route('cperalatan.index')->with('success', 'Data C-Peralatan & Mesin berhasil dihapus.');
    }
}
