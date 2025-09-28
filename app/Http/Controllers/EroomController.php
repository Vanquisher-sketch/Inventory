<?php

namespace App\Http\Controllers;

use App\Models\Eroom;
use Illuminate\Http\Request;

class EroomController extends Controller
{
    public function index()
    {
        $erooms = Eroom::latest()->get();
        return view('pages.eroom.index', compact('erooms'));
    }

    public function create()
    {
        return view('pages.eroom.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|unique:erooms,kode_ruangan|max:255',
        ]);
        Eroom::create($validatedData);
        return redirect()->route('eroom.index')->with('success', 'Data E-Room berhasil ditambahkan!');
    }

    public function edit(Eroom $eroom)
    {
        return view('pages.eroom.edit', compact('eroom'));
    }

    public function update(Request $request, Eroom $eroom)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|max:255|unique:erooms,kode_ruangan,' . $eroom->id,
        ]);
        $eroom->update($validatedData);
        return redirect()->route('eroom.index')->with('success', 'Data E-Room berhasil diubah!');
    }

    public function destroy(Eroom $eroom)
    {
        $eroom->delete();
        return redirect()->route('eroom.index')->with('success', 'Data E-Room berhasil dihapus!');
    }
}
