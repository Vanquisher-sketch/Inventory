<?php

namespace App\Http\Controllers;

use App\Models\Tanah;
use Illuminate\Http\Request;

class TanahController extends Controller
{
    public function index()
    {
        $tanahItems = Tanah::latest()->get();
        return view('pages.tanah.index', compact('tanahItems'));
    }

    public function create()
    {
        return view('pages.tanah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['kode_barang' => 'required|unique:tanahs,kode_barang']);
        Tanah::create($request->all());
        return redirect()->route('tanah.index')->with('success', 'Data Tanah berhasil ditambahkan.');
    }

    public function show(Tanah $tanah)
    {
        return view('pages.tanah.show', compact('tanah'));
    }

    public function edit(Tanah $tanah)
    {
        return view('pages.tanah.edit', compact('tanah'));
    }

    public function update(Request $request, Tanah $tanah)
    {
        $request->validate(['kode_barang' => 'required|unique:tanahs,kode_barang,' . $tanah->id]);
        $tanah->update($request->all());
        return redirect()->route('tanah.index')->with('success', 'Data Tanah berhasil diperbarui.');
    }

    public function destroy(Tanah $tanah)
    {
        $tanah->delete();
        return redirect()->route('tanah.index')->with('success', 'Data Tanah berhasil dihapus.');
    }
}