<?php

namespace App\Http\Controllers;

use App\Models\Lperalatan;
use Illuminate\Http\Request;

class LperalatanController extends Controller
{
    public function index()
    {
        $lperalatanItems = Lperalatan::latest()->paginate(15);
        return view('pages.lperalatan.index', compact('lperalatanItems'));
    }

    public function create()
    {
        return view('pages.lperalatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:lperalatans,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Lperalatan::create($request->all());
        return redirect()->route('lperalatan.index')->with('success', 'Data L-Peralatan & Mesin berhasil ditambahkan.');
    }

    public function edit(Lperalatan $lperalatan)
    {
        return view('pages.lperalatan.edit', compact('lperalatan'));
    }

    public function update(Request $request, Lperalatan $lperalatan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:lperalatans,kode_barang,' . $lperalatan->id,
            'harga' => 'required|numeric',
        ]);

        $lperalatan->update($request->all());
        return redirect()->route('lperalatan.index')->with('success', 'Data L-Peralatan & Mesin berhasil diperbarui.');
    }

    public function destroy(Lperalatan $lperalatan)
    {
        $lperalatan->delete();
        return redirect()->route('lperalatan.index')->with('success', 'Data L-Peralatan & Mesin berhasil dihapus.');
    }
}
