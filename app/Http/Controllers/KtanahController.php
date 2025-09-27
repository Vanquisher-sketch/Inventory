<?php

namespace App\Http\Controllers;

use App\Models\Ktanah;
use Illuminate\Http\Request;

class KtanahController extends Controller
{
    public function index()
    {
        $ktanahItems = Ktanah::latest()->get();
        return view('pages.ktanah.index', compact('ktanahItems'));
    }

    public function create()
    {
        return view('pages.ktanah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['kode_barang' => 'required|unique:ktanahs,kode_barang']);
        Ktanah::create($request->all());
        return redirect()->route('ktanah.index')->with('success', 'Data K-Tanah berhasil ditambahkan.');
    }

    public function show(Ktanah $ktanah)
    {
        return view('pages.ktanah.show', compact('ktanah'));
    }

    public function edit(Ktanah $ktanah)
    {
        return view('pages.ktanah.edit', compact('ktanah'));
    }

    public function update(Request $request, Ktanah $ktanah)
    {
        $request->validate(['kode_barang' => 'required|unique:ktanahs,kode_barang,' . $ktanah->id]);
        $ktanah->update($request->all());
        return redirect()->route('ktanah.index')->with('success', 'Data K-Tanah berhasil diperbarui.');
    }

    public function destroy(Ktanah $ktanah)
    {
        $ktanah->delete();
        return redirect()->route('ktanah.index')->with('success', 'Data K-Tanah berhasil dihapus.');
    }
}
