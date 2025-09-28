<?php

namespace App\Http\Controllers;

use App\Models\Etanah;
use Illuminate\Http\Request;

class EtanahController extends Controller
{
    public function index()
    {
        $etanahItems = Etanah::latest()->get();
        return view('pages.etanah.index', compact('etanahItems'));
    }

    public function create()
    {
        return view('pages.etanah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['kode_barang' => 'required|unique:etanahs,kode_barang']);
        Etanah::create($request->all());
        return redirect()->route('etanah.index')->with('success', 'Data E-Tanah berhasil ditambahkan.');
    }

    public function edit(Etanah $etanah)
    {
        return view('pages.etanah.edit', compact('etanah'));
    }

    public function update(Request $request, Etanah $etanah)
    {
        $request->validate(['kode_barang' => 'required|unique:etanahs,kode_barang,' . $etanah->id]);
        $etanah->update($request->all());
        return redirect()->route('etanah.index')->with('success', 'Data E-Tanah berhasil diperbarui.');
    }

    public function destroy(Etanah $etanah)
    {
        $etanah->delete();
        return redirect()->route('etanah.index')->with('success', 'Data E-Tanah berhasil dihapus.');
    }
}
