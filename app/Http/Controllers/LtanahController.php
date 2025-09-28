<?php

namespace App\Http\Controllers;

use App\Models\Ltanah;
use Illuminate\Http\Request;

class LtanahController extends Controller
{
    public function index()
    {
        $ltanahItems = Ltanah::latest()->get();
        return view('pages.ltanah.index', compact('ltanahItems'));
    }

    public function create()
    {
        return view('pages.ltanah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['kode_barang' => 'required|unique:ltanahs,kode_barang']);
        Ltanah::create($request->all());
        return redirect()->route('ltanah.index')->with('success', 'Data L-Tanah berhasil ditambahkan.');
    }

    public function edit(Ltanah $ltanah)
    {
        return view('pages.ltanah.edit', compact('ltanah'));
    }

    public function update(Request $request, Ltanah $ltanah)
    {
        $request->validate(['kode_barang' => 'required|unique:ltanahs,kode_barang,' . $ltanah->id]);
        $ltanah->update($request->all());
        return redirect()->route('ltanah.index')->with('success', 'Data L-Tanah berhasil diperbarui.');
    }

    public function destroy(Ltanah $ltanah)
    {
        $ltanah->delete();
        return redirect()->route('ltanah.index')->with('success', 'Data L-Tanah berhasil dihapus.');
    }
}
