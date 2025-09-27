<?php

namespace App\Http\Controllers;

use App\Models\Croom;
use Illuminate\Http\Request;

class CroomController extends Controller
{
    public function index()
    {
        $crooms = Croom::latest()->get();
        return view('pages.croom.index', compact('crooms'));
    }

    public function create()
    {
        return view('pages.croom.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|unique:crooms,kode_ruangan|max:255',
        ]);
        Croom::create($validatedData);
        return redirect()->route('croom.index')->with('success', 'Data C-Room berhasil ditambahkan!');
    }

    public function edit(Croom $croom)
    {
        return view('pages.croom.edit', compact('croom'));
    }

    public function update(Request $request, Croom $croom)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|max:255|unique:crooms,kode_ruangan,' . $croom->id,
        ]);
        $croom->update($validatedData);
        return redirect()->route('croom.index')->with('success', 'Data C-Room berhasil diubah!');
    }

    public function destroy(Croom $croom)
    {
        $croom->delete();
        return redirect()->route('croom.index')->with('success', 'Data C-Room berhasil dihapus!');
    }
}
