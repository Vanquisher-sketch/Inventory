<?php

namespace App\Http\Controllers;

use App\Models\Ctanah;
use Illuminate\Http\Request;

class CtanahController extends Controller
{
    public function index()
    {
        $ctanahItems = Ctanah::latest()->get();
        return view('pages.ctanah.index', compact('ctanahItems'));
    }

    public function create()
    {
        return view('pages.ctanah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['kode_barang' => 'required|unique:ctanahs,kode_barang']);
        Ctanah::create($request->all());
        return redirect()->route('ctanah.index')->with('success', 'Data C-Tanah berhasil ditambahkan.');
    }

    public function edit(Ctanah $ctanah)
    {
        return view('pages.ctanah.edit', compact('ctanah'));
    }

    public function update(Request $request, Ctanah $ctanah)
    {
        $request->validate(['kode_barang' => 'required|unique:ctanahs,kode_barang,' . $ctanah->id]);
        $ctanah->update($request->all());
        return redirect()->route('ctanah.index')->with('success', 'Data C-Tanah berhasil diperbarui.');
    }

    public function destroy(Ctanah $ctanah)
    {
        $ctanah->delete();
        return redirect()->route('ctanah.index')->with('success', 'Data C-Tanah berhasil dihapus.');
    }
}
