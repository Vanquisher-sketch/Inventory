<?php

namespace App\Http\Controllers;

use App\Models\Trusak;
use Illuminate\Http\Request;

class TrusakController extends Controller
{
    public function index()
    {
        $trusakItems = Trusak::latest()->paginate(15);
        return view('pages.trusak.index', compact('trusakItems'));
    }

    public function create()
    {
        return view('pages.trusak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:trusaks,no_id_pemda',
            'harga_perolehan' => 'required|numeric',
        ]);

        Trusak::create($request->all());
        return redirect()->route('trusak.index')->with('success', 'Data T-Barang Rusak berhasil ditambahkan.');
    }

    public function edit(Trusak $trusak)
    {
        return view('pages.trusak.edit', compact('trusak'));
    }

    public function update(Request $request, Trusak $trusak)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:trusaks,no_id_pemda,' . $trusak->id,
            'harga_perolehan' => 'required|numeric',
        ]);

        $trusak->update($request->all());
        return redirect()->route('trusak.index')->with('success', 'Data T-Barang Rusak berhasil diperbarui.');
    }

    public function destroy(Trusak $trusak)
    {
        $trusak->delete();
        return redirect()->route('trusak.index')->with('success', 'Data T-Barang Rusak berhasil dihapus.');
    }
}
