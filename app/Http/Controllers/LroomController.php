<?php

namespace App\Http\Controllers;

use App\Models\Lroom;
use Illuminate\Http\Request;

class LroomController extends Controller
{
    public function index()
    {
        $lrooms = Lroom::latest()->get();
        return view('pages.lroom.index', compact('lrooms'));
    }

    public function create()
    {
        return view('pages.lroom.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|unique:lrooms,kode_ruangan|max:255',
        ]);
        Lroom::create($validatedData);
        return redirect()->route('lroom.index')->with('success', 'Data L-Room berhasil ditambahkan!');
    }

    public function edit(Lroom $lroom)
    {
        return view('pages.lroom.edit', compact('lroom'));
    }

    public function update(Request $request, Lroom $lroom)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|max:255|unique:lrooms,kode_ruangan,' . $lroom->id,
        ]);
        $lroom->update($validatedData);
        return redirect()->route('lroom.index')->with('success', 'Data L-Room berhasil diubah!');
    }

    public function destroy(Lroom $lroom)
    {
        $lroom->delete();
        return redirect()->route('lroom.index')->with('success', 'Data L-Room berhasil dihapus!');
    }
}
