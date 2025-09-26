<?php

namespace App\Http\Controllers;

use App\Models\Jalan;
use Illuminate\Http\Request;

class JalanController extends Controller
{
    public function index()
    {
        $jalanItems = Jalan::latest()->paginate(15);
        return view('pages.jalan.index', compact('jalanItems'));
    }

    public function create()
    {
        return view('pages.jalan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:jalans,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Jalan::create($request->all());
        return redirect()->route('jalan.index')->with('success', 'Data Jalan, Irigasi & Jaringan berhasil ditambahkan.');
    }

    public function show(Jalan $jalan)
    {
        return view('pages.jalan.show', compact('jalan'));
    }

    public function edit(Jalan $jalan)
    {
        return view('pages.jalan.edit', compact('jalan'));
    }

    public function update(Request $request, Jalan $jalan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:jalans,kode_barang,' . $jalan->id,
            'harga' => 'required|numeric',
        ]);

        $jalan->update($request->all());
        return redirect()->route('jalan.index')->with('success', 'Data Jalan, Irigasi & Jaringan berhasil diperbarui.');
    }

    public function destroy(Jalan $jalan)
    {
        $jalan->delete();
        return redirect()->route('jalan.index')->with('success', 'Data Jalan, Irigasi & Jaringan berhasil dihapus.');
    }
}