<?php

namespace App\Http\Controllers;

use App\Models\Rusak;
use Illuminate\Http\Request;

class RusakController extends Controller
{
    public function index()
    {
        $rusakItems = Rusak::latest()->paginate(15);
        return view('pages.rusak.index', compact('rusakItems'));
    }

    public function create()
    {
        return view('pages.rusak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:rusaks,no_id_pemda',
            'harga_perolehan' => 'required|numeric',
            'tahun_perolehan' => 'required|digits:4',
        ]);

        Rusak::create($request->all());
        return redirect()->route('rusak.index')->with('success', 'Data Barang Rusak berhasil ditambahkan.');
    }

    public function show(Rusak $rusak)
    {
        return view('pages.rusak.show', compact('rusak'));
    }

    public function edit(Rusak $rusak)
    {
        return view('pages.rusak.edit', compact('rusak'));
    }

    public function update(Request $request, Rusak $rusak)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:rusaks,no_id_pemda,' . $rusak->id,
            'harga_perolehan' => 'required|numeric',
            'tahun_perolehan' => 'required|digits:4',
        ]);

        $rusak->update($request->all());
        return redirect()->route('rusak.index')->with('success', 'Data Barang Rusak berhasil diperbarui.');
    }

    public function destroy(Rusak $rusak)
    {
        $rusak->delete();
        return redirect()->route('rusak.index')->with('success', 'Data Barang Rusak berhasil dihapus.');
    }
}