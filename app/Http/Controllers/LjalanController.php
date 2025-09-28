<?php

namespace App\Http\Controllers;

use App\Models\Ljalan;
use Illuminate\Http\Request;

class LjalanController extends Controller
{
    public function index()
    {
        $ljalanItems = Ljalan::latest()->paginate(15);
        return view('pages.ljalan.index', compact('ljalanItems'));
    }

    public function create()
    {
        return view('pages.ljalan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:ljalans,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Ljalan::create($request->all());
        return redirect()->route('ljalan.index')->with('success', 'Data L-Jalan, Irigasi & Jaringan berhasil ditambahkan.');
    }

    public function edit(Ljalan $ljalan)
    {
        return view('pages.ljalan.edit', compact('ljalan'));
    }

    public function update(Request $request, Ljalan $ljalan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:ljalans,kode_barang,' . $ljalan->id,
            'harga' => 'required|numeric',
        ]);

        $ljalan->update($request->all());
        return redirect()->route('ljalan.index')->with('success', 'Data L-Jalan, Irigasi & Jaringan berhasil diperbarui.');
    }

    public function destroy(Ljalan $ljalan)
    {
        $ljalan->delete();
        return redirect()->route('ljalan.index')->with('success', 'Data L-Jalan, Irigasi & Jaringan berhasil dihapus.');
    }
}
