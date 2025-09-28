<?php

namespace App\Http\Controllers;

use App\Models\Cinventaris;
use App\Models\Croom;
use Illuminate\Http\Request;
use PDF;

class CinventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Cinventaris::with('croom');
        $selectedCroom = null;

        if ($request->filled('croom_id')) {
            $query->where('croom_id', $request->croom_id);
            $selectedCroom = Croom::find($request->croom_id);
        }

        $cinventarissItems = $query->latest()->get();
        $crooms = Croom::orderBy('name')->get();

        return view('pages.cinventaris.index', compact('cinventarisItems', 'crooms', 'selectedCroom'));
    }

    public function create()
    {
        $crooms = Croom::orderBy('name')->get();
        return view('pages.cinventaris.create', compact('crooms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'croom_id' => 'required|exists:crooms,id',
            'nama_barang' => 'required|string|max:255',
            'merk_model' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'tahun_pembelian' => 'nullable|digits:4',
            'kode_barang' => 'required|string|max:255|unique:cinventaris,kode_barang',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
            'keterangan' => 'nullable|string',
        ]);

        Cinventaris::create($validatedData);
        return redirect()->route('cinventaris.index')->with('success', 'Data C-Inventaris berhasil ditambahkan.');
    }

    public function edit(Cinventaris $cinventaris)
    {
        $crooms = Croom::orderBy('name')->get();
        return view('pages.cinventaris.edit', compact('cinventari', 'crooms'));
    }

    public function update(Request $request, Cinventaris $cinventaris)
    {
        $validatedData = $request->validate([
            'croom_id' => 'required|exists:crooms,id',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:cinventaris,kode_barang,' . $cinventaris->id,
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
            'keterangan' => 'nullable|string',
        ]);

        $cinventaris->update($validatedData);
        return redirect()->route('cinventaris.index')->with('success', 'Data C-Inventaris berhasil diubah.');
    }

    public function destroy(Cinventaris $cinventaris)
    {
        $cinventaris->delete();
        return redirect()->route('cinventaris.index')->with('success', 'Data C-Inventaris berhasil dihapus.');
    }
}
