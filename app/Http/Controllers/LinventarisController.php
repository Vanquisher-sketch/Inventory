<?php

namespace App\Http\Controllers;

use App\Models\Linventaris;
use App\Models\Lroom;
use Illuminate\Http\Request;
use PDF;

class LinventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Linventaris::with('lroom');
        $selectedLroom = null;

        if ($request->filled('lroom_id')) {
            $query->where('lroom_id', $request->lroom_id);
            $selectedLroom = Lroom::find($request->lroom_id);
        }

        $linventarissItems = $query->latest()->get();
        $lrooms = Lroom::orderBy('name')->get();

        return view('pages.linventaris.index', compact('linventarisItems', 'lrooms', 'selectedLroom'));
    }

    public function create()
    {
        $lrooms = Lroom::orderBy('name')->get();
        return view('pages.linventaris.create', compact('lrooms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lroom_id' => 'required|exists:lrooms,id',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:linventaris,kode_barang',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
        ]);

        Linventaris::create($validatedData);
        return redirect()->route('linventaris.index')->with('success', 'Data L-Inventaris berhasil ditambahkan.');
    }

    public function edit(Linventaris $linventaris)
    {
        $lrooms = Lroom::orderBy('name')->get();
        return view('pages.linventaris.edit', compact('linventari', 'lrooms'));
    }

    public function update(Request $request, Linventaris $linventaris)
    {
        $validatedData = $request->validate([
            'lroom_id' => 'required|exists:lrooms,id',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:linventaris,kode_barang,' . $linventaris->id,
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
        ]);

        $linventaris->update($validatedData);
        return redirect()->route('linventaris.index')->with('success', 'Data L-Inventaris berhasil diubah.');
    }

    public function destroy(Linventaris $linventaris)
    {
        $linventaris->delete();
        return redirect()->route('linventaris.index')->with('success', 'Data L-Inventaris berhasil dihapus.');
    }
}
