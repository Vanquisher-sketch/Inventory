<?php

namespace App\Http\Controllers;

use App\Models\Kinventaris;
use App\Models\Kroom; // Menggunakan model Kroom
use Illuminate\Http\Request;
use PDF; // Pastikan Anda sudah `use PDF;`

class KinventarisController extends Controller
{
    /**
     * Menampilkan daftar kinventaris dengan fungsionalitas filter.
     */
    public function index(Request $request)
    {
        // Query dasar untuk kinventaris, eager load relasi 'kroom' untuk efisiensi
        $query = Kinventaris::with('kroom');
        
        $selectedKroom = null;

        // Terapkan filter jika ada kroom_id yang valid di request
        if ($request->filled('kroom_id')) {
            $query->where('kroom_id', $request->kroom_id);
            // Menggunakan find() untuk mengambil SATU objek ruangan, bukan get()
            $selectedKroom = Kroom::find($request->kroom_id);
        }

        // Ambil hasil query kinventaris (ini adalah collection, untuk ditampilkan di tabel)
        $kinventarissItems = $query->latest()->get();
        
        // Ambil semua ruangan (ini adalah collection, untuk dropdown filter)
        $krooms = Kroom::orderBy('name')->get();

        // Kirim semua variabel yang dibutuhkan ke view
        return view('pages.kinventaris.index', compact('kinventarisItems', 'krooms', 'selectedKroom'));
    }

    /**
     * Menampilkan form untuk membuat kinventaris baru.
     */
    public function create()
    {
        $krooms = Kroom::orderBy('name')->get();
        return view('pages.kinventaris.create', compact('krooms'));
    }

    /**
     * Menyimpan data kinventaris baru ke database.
     */
    public function store(Request $request)
    {
        // Aturan validasi untuk data yang masuk dari form
        $validatedData = $request->validate([
            'kroom_id' => 'required|exists:krooms,id',
            'nama_barang' => 'required|string|max:255',
            'merk_model' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'tahun_pembelian' => 'nullable|digits:4',
            'kode_barang' => 'required|string|max:255|unique:kinventaris,kode_barang',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB', // Memastikan nilai hanya B, KB, atau RB
            'keterangan' => 'nullable|string',
        ]);

        Kinventaris::create($validatedData);

        return redirect()->route('kinventaris.index')->with('success', 'Data K-Inventaris berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu item kinventaris.
     */
    public function show(Kinventaris $kinventaris)
    {
        // Variabel $kinventaris sudah otomatis diambil dari database berkat Route Model Binding
        return view('pages.kinventaris.show', compact('kinventari'));
    }

    /**
     * Menampilkan form untuk mengedit kinventaris.
     */
    public function edit(Kinventaris $kinventaris)
    {
        $krooms = Kroom::orderBy('name')->get();
        return view('pages.kinventaris.edit', compact('kinventari', 'krooms'));
    }

    /**
     * Memperbarui data kinventaris di database.
     */
    public function update(Request $request, Kinventaris $kinventaris)
    {
        $validatedData = $request->validate([
            'kroom_id' => 'required|exists:krooms,id',
            'nama_barang' => 'required|string|max:255',
            'merk_model' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'tahun_pembelian' => 'nullable|digits:4',
            'kode_barang' => 'required|string|max:255|unique:kinventaris,kode_barang,' . $kinventaris->id,
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
            'keterangan' => 'nullable|string',
        ]);

        $kinventaris->update($validatedData);

        return redirect()->route('kinventaris.index')->with('success', 'Data K-Inventaris berhasil diubah.');
    }

    /**
     * Menghapus data kinventaris dari database.
     */
    public function destroy(Kinventaris $kinventaris)
    {
        $kinventaris->delete();
        return redirect()->route('kinventaris.index')->with('success', 'Data K-Inventaris berhasil dihapus.');
    }

    /**
     * Method custom untuk memindahkan item kinventaris ke ruangan lain.
     */
    public function move(Request $request, Kinventaris $kinventaris)
    {
        $request->validate([
            'new_kroom_id' => 'required|exists:krooms,id',
        ]);

        $kinventaris->update(['kroom_id' => $request->new_kroom_id]);

        return redirect()->back()->with('success', 'Barang berhasil dipindahkan ke K-Room baru.');
    }

    /**
     * Method custom untuk mencetak laporan kinventaris dalam format PDF.
     */
    public function printPDF(Request $request)
    {
        // Logika filter disalin dari method index() untuk konsistensi data
        $query = Kinventaris::with('kroom');
        $selectedKroom = null;
        if ($request->filled('kroom_id')) {
            $query->where('kroom_id', $request->kroom_id);
            $selectedKroom = Kroom::find($request->kroom_id);
        }
        $kinventaris = $query->get();

        $pdf = PDF::loadView('pages.kinventaris.cetak', compact('kinventaris', 'selectedKroom'));
        $pdf->setPaper('A4', 'landscape'); 
        
        return $pdf->stream('laporan-kinventaris.pdf');
    }
}
