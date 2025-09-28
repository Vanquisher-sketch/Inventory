<?php

namespace App\Http\Controllers;

use App\Models\Troom;
use Illuminate\Http\Request;

class TroomController extends Controller
{
    public function index()
    {
        $trooms = Troom::latest()->get();
        return view('pages.troom.index', compact('trooms'));
    }

    public function create()
    {
        return view('pages.troom.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|unique:trooms,kode_ruangan|max:255',
        ]);
        Troom::create($validatedData);
        return redirect()->route('troom.index')->with('success', 'Data T-Room berhasil ditambahkan!');
    }

    public function edit(Troom $troom)
    {
        return view('pages.troom.edit', compact('troom'));
    }

    public function update(Request $request, Troom $troom)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|max:255|unique:trooms,kode_ruangan,' . $troom->id,
        ]);
        $troom->update($validatedData);
        return redirect()->route('troom.index')->with('success', 'Data T-Room berhasil diubah!');
    }

    public function destroy(Troom $troom)
    {
        $troom->delete();
        return redirect()->route('troom.index')->with('success', 'Data T-Room berhasil dihapus!');
    }
}
