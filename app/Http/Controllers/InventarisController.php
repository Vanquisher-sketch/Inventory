<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Room;
use Illuminate\Http\Request;
use PDF; // Pastikan Anda sudah `use PDF;`

class InventarisController extends Controller
{
    /**
     * Menampilkan daftar inventaris dengan fungsionalitas filter.
     */
    public function index(Request $request)
    {
        // Query dasar untuk inventaris, eager load relasi 'room' untuk efisiensi
        $query = Inventaris::with('room');
        
        $selectedRoom = null;

        // Terapkan filter jika ada room_id yang valid di request
        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
            // Menggunakan find() untuk mengambil SATU objek ruangan, bukan get()
            $selectedRoom = Room::find($request->room_id);
        }

        // Ambil hasil query inventaris (ini adalah collection, untuk ditampilkan di tabel)
        $inventaris = $query->latest()->get();
        
        // Ambil semua ruangan (ini adalah collection, untuk dropdown filter)
        $rooms = Room::orderBy('name')->get();

        // Kirim semua variabel yang dibutuhkan ke view
        return view('pages.inventaris.index', compact('inventaris', 'rooms', 'selectedRoom'));
    }

    /**
     * Menampilkan form untuk membuat inventaris baru.
     */
    public function create()
    {
        $rooms = Room::orderBy('name')->get();
        return view('pages.inventaris.create', compact('rooms'));
    }

    /**
     * Menyimpan data inventaris baru ke database.
     */
    public function store(Request $request)
    {
        // Aturan validasi untuk data yang masuk dari form
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'nama_barang' => 'required|string|max:255',
            'merk_model' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'tahun_pembelian' => 'nullable|digits:4',
            'kode_barang' => 'required|string|max:255|unique:inventaris,kode_barang',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB', // Memastikan nilai hanya B, KB, atau RB
            'keterangan' => 'nullable|string',
        ]);

        Inventaris::create($validatedData);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu item inventaris.
     */
    public function show(Inventaris $inventaris)
    {
        // Variabel $inventaris sudah otomatis diambil dari database berkat Route Model Binding
        return view('pages.inventaris.show', compact('inventaris'));
    }

    /**
     * Menampilkan form untuk mengedit inventaris.
     */
    // app/Http/Controllers/InventarisController.php

    public function edit(Inventaris $inventaris)
    {
        // Mengambil semua ruangan untuk dropdown "Lokasi Ruangan"
        $rooms = Room::orderBy('name')->get();
        
        // Mengirim data inventaris spesifik DAN daftar semua ruangan ke view
        return view('pages.inventaris.edit', compact('inventaris', 'rooms'));
    }

    /**
     * Memperbarui data inventaris di database.
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'nama_barang' => 'required|string|max:255',
            // ... (validasi lain sama seperti di store)
            // Aturan unique diupdate agar tidak error saat kodenya tidak diubah
            'kode_barang' => 'required|string|max:255|unique:inventaris,kode_barang,' . $inventaris->id,
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'kondisi' => 'required|string|in:B,KB,RB',
            'keterangan' => 'nullable|string',
        ]);

        $inventaris->update($validatedData);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diubah.');
    }

    /**
     * Menghapus data inventaris dari database.
     */
    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();
        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil dihapus.');
    }

    /**
     * Method custom untuk memindahkan item inventaris ke ruangan lain.
     */
    public function move(Request $request, Inventaris $inventaris)
    {
        $request->validate([
            'new_room_id' => 'required|exists:rooms,id',
        ]);

        $inventaris->update(['room_id' => $request->new_room_id]);

        return redirect()->back()->with('success', 'Barang berhasil dipindahkan ke ruangan baru.');
    }

    /**
     * Method custom untuk mencetak laporan inventaris dalam format PDF.
     */
    public function printPDF(Request $request)
    {
        // Logika filter disalin dari method index() untuk konsistensi data
        $query = Inventaris::with('room');
        $selectedRoom = null;
        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
            $selectedRoom = Room::find($request->room_id);
        }
        $inventaris = $query->get();

        $pdf = PDF::loadView('pages.inventaris.cetak', compact('inventaris', 'selectedRoom'));
        // Mengatur orientasi kertas menjadi landscape (melebar) agar tabel muat
        $pdf->setPaper('A4', 'landscape'); 
        
        return $pdf->stream('laporan-inventaris.pdf');
    }
}