<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            // Query for searching based on id, merk, seri, etc.
            $rsBarang = DB::table('barang')
                ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                ->select(
                    'barang.id',
                    'barang.merk',
                    'barang.seri',
                    'barang.spesifikasi',
                    'barang.stok',
                    'kategori.deskripsi as kategori',
                    // DB::raw('ketKategori(kategori.id) as keterangan')  // Use ketKategori function
                )
                ->where('barang.id', 'like', '%' . $request->search . '%')
                ->orWhere('barang.merk', 'like', '%' . $request->search . '%')
                ->orWhere('barang.seri', 'like', '%' . $request->search . '%')
                ->orWhere('barang.spesifikasi', 'like', '%' . $request->search . '%')
                ->orWhere('barang.stok', 'like', '%' . $request->search . '%')
                ->orWhere('kategori.deskripsi', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            // Query without search
            $rsBarang = DB::table('barang')
                ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                ->select(
                    'barang.id',
                    'barang.merk',
                    'barang.seri',
                    'barang.spesifikasi',
                    'barang.stok',
                    'kategori.deskripsi as kategori',
                    // DB::raw('ketKategori(kategori.id) as keterangan')  // Use ketKategori function
                )
                ->paginate(10);
        }

        return view('backend.barang.index', compact('rsBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data kategori untuk dropdown
        $listKategori = KategoriModel::pluck('deskripsi', 'id');

        return view('backend.barang.create', compact('listKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            // 'stok' => 'integer',
            'kategori_id' => 'required|exists:kategori,id'  // Foreign key validation
        ]);

        // Cek apakah data dengan kategori_id, merk, dan seri sudah ada
        $existingData = BarangModel::where('kategori_id', $request->kategori_id)
            ->where('merk', $request->merk)
            ->where('seri', $request->seri)
            ->first();

        // Jika ada data yang sama, hapus terlebih dahulu
        if ($existingData) {
            $existingData->delete();
        }

        // Lanjut simpan data baru
        BarangModel::create([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'stok' => '0',
            'kategori_id' => $request->kategori_id,
        ]);

        // Redirect ke halaman index barang dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil entri tabel
        $rsBarang = DB::table('barang')
        ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
        ->select(
            'barang.id',
            'barang.merk',
            'barang.seri',
            'barang.spesifikasi',
            'barang.stok',
            // 'kategori.deskripsi as kategori',
            'kategori.deskripsi as kategori'  // Use ketKategori function for keterangan
        )
        ->where('barang.id', $id)
        ->first();

        return view('backend.barang.show', compact('rsBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the specific barang record to be edited
        $rsBarang = DB::table('barang')
            ->select('id', 'merk', 'seri', 'spesifikasi', 'stok', 'kategori_id')
            ->where('id', $id)
            ->first();

        // Retrieve all categories to populate the dropdown list
        $listKategori = KategoriModel::pluck('deskripsi', 'id');
        
        // Pass both the barang record and the list of categories to the view
        return view('backend.barang.edit', compact('rsBarang', 'listKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            // 'stok' => 'integer',
            'kategori_id' => 'required|exists:kategori,id',  // Foreign key validation
        ]);

        // Update data barang tanpa mengubah ID
        DB::table('barang')
            ->where('id', $id)
            ->update([
                'merk' => $request->merk,
                'seri' => $request->seri,
                'spesifikasi' => $request->spesifikasi,
                // 'stok' => $request->stok,
                'kategori_id' => $request->kategori_id,  // Updated to kategori_id
            ]);

        return redirect()->route('barang.index')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data barang berdasarkan ID
        if (DB::table('barang_masuk')->where('barang_id', $id)->exists()){
            return redirect()->route('barang.index')->with(['gagal' => 'Data Gagal Dihapus! Data masih digunakan']);            
        } else {
        $rsetBarang = BarangModel::find($id);
        $rsetBarang->delete();
        }

        // Resequencing semua ID yang ada agar berurutan kembali tanpa celah
        $rowBarang = BarangModel::orderBy('id')->get();  // Ambil semua data barang yang tersisa
        $newId = 1;

        // warning hapus data terkait

        // Update ulang ID dari 1 ke seterusnya
        foreach ($rowBarang as $item) {
            DB::table('barang')
                ->where('id', $item->id)
                ->update(['id' => $newId]); // Update ID menjadi urutan baru
            $newId++;
        }

        // Setelah semua ID diurutkan ulang, reset AUTO_INCREMENT agar sesuai dengan ID terakhir
        DB::statement('ALTER TABLE barang AUTO_INCREMENT = ' . ($newId));

        return redirect()->route('barang.index')->with('success', 'Data Berhasil Dihapus!');
    }
}