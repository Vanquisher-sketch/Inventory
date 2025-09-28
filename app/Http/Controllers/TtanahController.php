<?php

namespace App\Http\Controllers;

use App\Models\Ttanah;
use Illuminate\Http\Request;

class TtanahController extends Controller
{
    public function index()
    {
        $ttanahItems = Ttanah::latest()->get();
        return view('pages.ttanah.index', compact('ttanahItems'));
    }

    public function create()
    {
        return view('pages.ttanah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['kode_barang' => 'required|unique:ttanahs,kode_barang']);
        Ttanah::create($request->all());
        return redirect()->route('ttanah.index')->with('success', 'Data T-Tanah berhasil ditambahkan.');
    }

    public function edit(Ttanah $ttanah)
    {
        return view('pages.ttanah.edit', compact('ttanah'));
    }

    public function update(Request $request, Ttanah $ttanah)
    {
        $request->validate(['kode_barang' => 'required|unique:ttanahs,kode_barang,' . $ttanah->id]);
        $ttanah->update($request->all());
        return redirect()->route('ttanah.index')->with('success', 'Data T-Tanah berhasil diperbarui.');
    }

    public function destroy(Ttanah $ttanah)
    {
        $ttanah->delete();
        return redirect()->route('ttanah.index')->with('success', 'Data T-Tanah berhasil dihapus.');
    }
}
