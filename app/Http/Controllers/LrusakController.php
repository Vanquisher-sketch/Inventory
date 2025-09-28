<?php

namespace App\Http\Controllers;

use App\Models\Lrusak;
use Illuminate\Http\Request;

class LrusakController extends Controller
{
    public function index()
    {
        $lrusakItems = Lrusak::latest()->paginate(15);
        return view('pages.lrusak.index', compact('lrusakItems'));
    }

    public function create()
    {
        return view('pages.lrusak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:lrusaks,no_id_pemda',
            'harga_perolehan' => 'required|numeric',
        ]);

        Lrusak::create($request->all());
        return redirect()->route('lrusak.index')->with('success', 'Data L-Barang Rusak berhasil ditambahkan.');
    }

    public function edit(Lrusak $lrusak)
    {
        return view('pages.lrusak.edit', compact('lrusak'));
    }

    public function update(Request $request, Lrusak $lrusak)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:lrusaks,no_id_pemda,' . $lrusak->id,
            'harga_perolehan' => 'required|numeric',
        ]);

        $lrusak->update($request->all());
        return redirect()->route('lrusak.index')->with('success', 'Data L-Barang Rusak berhasil diperbarui.');
    }

    public function destroy(Lrusak $lrusak)
    {
        $lrusak->delete();
        return redirect()->route('lrusak.index')->with('success', 'Data L-Barang Rusak berhasil dihapus.');
    }
}
