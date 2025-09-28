<?php

namespace App\Http\Controllers;

use App\Models\Tinventaris;
use App\Models\Troom;
use Illuminate\Http\Request;
use PDF;

class TinventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Tinventaris::with('troom');
        $selectedTroom = null;

        if ($request->filled('troom_id')) {
            $query->where('troom_id', $request->troom_id);
            $selectedTroom = Troom::find($request->troom_id);
        }

        $tinventarissItems = $query->latest()->get();
        $trooms = Troom::orderBy('name')->get();

        return view('pages.tinventaris.index', compact('tinventarisItems', 'trooms', 'selectedTroom'));
    }

    public function create()
    {
        $trooms = Troom::orderBy('name')->get();
        return view('pages.tinventaris.create', compact('trooms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'troom_id' => 'required|exists:trooms,id',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:tinventaris,kode_barang',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
        ]);

        Tinventaris::create($validatedData);
        return redirect()->route('tinventaris.index')->with('success', 'Data T-Inventaris berhasil ditambahkan.');
    }

    public function edit(Tinventaris $tinventaris)
    {
        $trooms = Troom::orderBy('name')->get();
        return view('pages.tinventaris.edit', compact('tinventari', 'trooms'));
    }

    public function update(Request $request, Tinventaris $tinventaris)
    {
        $validatedData = $request->validate([
            'troom_id' => 'required|exists:trooms,id',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:tinventaris,kode_barang,' . $tinventaris->id,
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
        ]);

        $tinventaris->update($validatedData);
        return redirect()->route('tinventaris.index')->with('success', 'Data T-Inventaris berhasil diubah.');
    }

    public function destroy(Tinventaris $tinventaris)
    {
        $tinventaris->delete();
        return redirect()->route('tinventaris.index')->with('success', 'Data T-Inventaris berhasil dihapus.');
    }
}
