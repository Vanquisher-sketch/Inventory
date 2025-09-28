<?php

namespace App\Http\Controllers;

use App\Models\Tjalan;
use Illuminate\Http\Request;

class TjalanController extends Controller
{
    public function index()
    {
        $tjalanItems = Tjalan::latest()->paginate(15);
        return view('pages.tjalan.index', compact('tjalanItems'));
    }

    public function create()
    {
        return view('pages.tjalan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:tjalans,kode_barang',
            'harga' => 'required|numeric',
        ]);

        Tjalan::create($request->all());
        return redirect()->route('tjalan.index')->with('success', 'Data T-Jalan, Irigasi & Jaringan berhasil ditambahkan.');
    }

    public function edit(Tjalan $tjalan)
    {
        return view('pages.tjalan.edit', compact('tjalan'));
    }

    public function update(Request $request, Tjalan $tjalan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:tjalans,kode_barang,' . $tjalan->id,
            'harga' => 'required|numeric',
        ]);

        $tjalan->update($request->all());
        return redirect()->route('tjalan.index')->with('success', 'Data T-Jalan, Irigasi & Jaringan berhasil diperbarui.');
    }

    public function destroy(Tjalan $tjalan)
    {
        $tjalan->delete();
        return redirect()->route('tjalan.index')->with('success', 'Data T-Jalan, Irigasi & Jaringan berhasil dihapus.');
    }
}
