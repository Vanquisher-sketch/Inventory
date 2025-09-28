<?php

namespace App\Http\Controllers;

use App\Models\Erusak;
use Illuminate\Http\Request;

class ErusakController extends Controller
{
    public function index()
    {
        $erusakItems = Erusak::latest()->paginate(15);
        return view('pages.erusak.index', compact('erusakItems'));
    }

    public function create()
    {
        return view('pages.erusak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:erusaks,no_id_pemda',
            'harga_perolehan' => 'required|numeric',
        ]);

        Erusak::create($request->all());
        return redirect()->route('erusak.index')->with('success', 'Data E-Barang Rusak berhasil ditambahkan.');
    }

    public function edit(Erusak $erusak)
    {
        return view('pages.erusak.edit', compact('erusak'));
    }

    public function update(Request $request, Erusak $erusak)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:erusaks,no_id_pemda,' . $erusak->id,
            'harga_perolehan' => 'required|numeric',
        ]);

        $erusak->update($request->all());
        return redirect()->route('erusak.index')->with('success', 'Data E-Barang Rusak berhasil diperbarui.');
    }

    public function destroy(Erusak $erusak)
    {
        $erusak->delete();
        return redirect()->route('erusak.index')->with('success', 'Data E-Barang Rusak berhasil dihapus.');
    }
}
