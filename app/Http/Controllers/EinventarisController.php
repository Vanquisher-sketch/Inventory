<?php

namespace App\Http\Controllers;

use App\Models\Einventaris;
use App\Models\Eroom;
use Illuminate\Http\Request;
use PDF;

class EinventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Einventaris::with('eroom');
        $selectedEroom = null;

        if ($request->filled('eroom_id')) {
            $query->where('eroom_id', $request->eroom_id);
            $selectedEroom = Eroom::find($request->eroom_id);
        }

        $einventarissItems = $query->latest()->get();
        $erooms = Eroom::orderBy('name')->get();

        return view('pages.einventaris.index', compact('einventarisItems', 'erooms', 'selectedEroom'));
    }

    public function create()
    {
        $erooms = Eroom::orderBy('name')->get();
        return view('pages.einventaris.create', compact('erooms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'eroom_id' => 'required|exists:erooms,id',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:einventaris,kode_barang',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
        ]);

        Einventaris::create($validatedData);
        return redirect()->route('einventaris.index')->with('success', 'Data E-Inventaris berhasil ditambahkan.');
    }

    public function edit(Einventaris $einventaris)
    {
        $erooms = Eroom::orderBy('name')->get();
        return view('pages.einventaris.edit', compact('einventari', 'erooms'));
    }

    public function update(Request $request, Einventaris $einventaris)
    {
        $validatedData = $request->validate([
            'eroom_id' => 'required|exists:erooms,id',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:einventaris,kode_barang,' . $einventaris->id,
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
        ]);

        $einventaris->update($validatedData);
        return redirect()->route('einventaris.index')->with('success', 'Data E-Inventaris berhasil diubah.');
    }

    public function destroy(Einventaris $einventaris)
    {
        $einventaris->delete();
        return redirect()->route('einventaris.index')->with('success', 'Data E-Inventaris berhasil dihapus.');
    }
}
