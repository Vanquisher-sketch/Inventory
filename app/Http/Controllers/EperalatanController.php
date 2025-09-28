<?php

namespace App\Http\Controllers;

use App\Models\Eperalatan;
use Illuminate\Http\Request;

class EperalatanController extends Controller
{
    public function index()
    {
        $eperalatanItems = Eperalatan::latest()->paginate(15);
        return view('pages.eperalatan.index', compact('eperalatanItems'));
    }

    public function create()
    {
        return view('pages.eperalatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:eperalatans,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Eperalatan::create($request->all());
        return redirect()->route('eperalatan.index')->with('success', 'Data E-Peralatan & Mesin berhasil ditambahkan.');
    }

    public function edit(Eperalatan $eperalatan)
    {
        return view('pages.eperalatan.edit', compact('eperalatan'));
    }

    public function update(Request $request, Eperalatan $eperalatan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:eperalatans,kode_barang,' . $eperalatan->id,
            'harga' => 'required|numeric',
        ]);

        $eperalatan->update($request->all());
        return redirect()->route('eperalatan.index')->with('success', 'Data E-Peralatan & Mesin berhasil diperbarui.');
    }

    public function destroy(Eperalatan $eperalatan)
    {
        $eperalatan->delete();
        return redirect()->route('eperalatan.index')->with('success', 'Data E-Peralatan & Mesin berhasil dihapus.');
    }
}
