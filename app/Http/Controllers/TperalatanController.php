<?php

namespace App\Http\Controllers;

use App\Models\Tperalatan;
use Illuminate\Http\Request;

class TperalatanController extends Controller
{
    public function index()
    {
        $tperalatanItems = Tperalatan::latest()->paginate(15);
        return view('pages.tperalatan.index', compact('tperalatanItems'));
    }

    public function create()
    {
        return view('pages.tperalatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:tperalatans,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Tperalatan::create($request->all());
        return redirect()->route('tperalatan.index')->with('success', 'Data T-Peralatan & Mesin berhasil ditambahkan.');
    }

    public function edit(Tperalatan $tperalatan)
    {
        return view('pages.tperalatan.edit', compact('tperalatan'));
    }

    public function update(Request $request, Tperalatan $tperalatan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:tperalatans,kode_barang,' . $tperalatan->id,
            'harga' => 'required|numeric',
        ]);

        $tperalatan->update($request->all());
        return redirect()->route('tperalatan.index')->with('success', 'Data T-Peralatan & Mesin berhasil diperbarui.');
    }

    public function destroy(Tperalatan $tperalatan)
    {
        $tperalatan->delete();
        return redirect()->route('tperalatan.index')->with('success', 'Data T-Peralatan & Mesin berhasil dihapus.');
    }
}
