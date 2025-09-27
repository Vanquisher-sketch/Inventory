<?php

namespace App\Http\Controllers;

use App\Models\Crusak;
use Illuminate\Http\Request;

class CrusakController extends Controller
{
    public function index()
    {
        $crusakItems = Crusak::latest()->paginate(15);
        return view('pages.crusak.index', compact('crusakItems'));
    }

    public function create()
    {
        return view('pages.crusak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:crusaks,no_id_pemda',
        ]);

        Crusak::create($request->all());
        return redirect()->route('crusak.index')->with('success', 'Data C-Barang Rusak berhasil ditambahkan.');
    }

    public function edit(Crusak $crusak)
    {
        return view('pages.crusak.edit', compact('crusak'));
    }

    public function update(Request $request, Crusak $crusak)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'no_id_pemda' => 'required|string|unique:crusaks,no_id_pemda,' . $crusak->id,
        ]);

        $crusak->update($request->all());
        return redirect()->route('crusak.index')->with('success', 'Data C-Barang Rusak berhasil diperbarui.');
    }

    public function destroy(Crusak $crusak)
    {
        $crusak->delete();
        return redirect()->route('crusak.index')->with('success', 'Data C-Barang Rusak berhasil dihapus.');
    }
}
