<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function index()
    {
        $peralatanItems = Peralatan::latest()->paginate(15); // Menampilkan 15 item per halaman
        return view('pages.peralatan.index', compact('peralatanItems'));
    }

    public function create()
    {
        return view('pages.peralatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:peralatans,kode_barang',
            'harga' => 'required|numeric',
            'tahun_pembelian' => 'required|digits:4',
        ]);

        Peralatan::create($request->all());
        return redirect()->route('peralatan.index')->with('success', 'Data Peralatan & Mesin berhasil ditambahkan.');
    }

    public function show(Peralatan $peralatan)
    {
        return view('pages.peralatan.show', compact('peralatan'));
    }

    public function edit(Peralatan $peralatan)
    {
        return view('pages.peralatan.edit', compact('peralatan'));
    }

    public function update(Request $request, Peralatan $peralatan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:peralatans,kode_barang,' . $peralatan->id,
            'harga' => 'required|numeric',
            'tahun_pembelian' => 'required|digits:4',
        ]);

        $peralatan->update($request->all());
        return redirect()->route('peralatan.index')->with('success', 'Data Peralatan & Mesin berhasil diperbarui.');
    }

    public function destroy(Peralatan $peralatan)
    {
        $peralatan->delete();
        return redirect()->route('peralatan.index')->with('success', 'Data Peralatan & Mesin berhasil dihapus.');
    }
}