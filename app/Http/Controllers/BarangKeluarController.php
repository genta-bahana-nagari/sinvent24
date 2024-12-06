<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BarangKeluar;
use App\Models\BarangModel;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $rsKeluar = DB::table('barang_keluar')
                ->join('barang as b', 'barang_keluar.barang_id', '=', 'b.id') // Join dengan tabel barang
                ->join('kategori as k', 'b.kategori_id', '=', 'k.id') // Join ke tabel kategori berdasarkan kategori di barang
                ->select(
                    'barang_keluar.id',
                    'k.deskipsi as kategori',
                    'b.merk',    // Ambil kolom merk dari tabel barang
                    'b.seri',    // Ambil kolom seri dari tabel barang
                    'barang_keluar.tgl_keluar',  // Ganti ke tgl_keluar
                    'barang_keluar.qty_keluar'   // Ganti ke qty_keluar
                )
                ->where('barang_keluar.id', 'like', '%' . $request->search . '%')
                ->orWhere('b.merk', 'like', '%' . $request->search . '%') // Search based on merk
                ->paginate(10);
        } else {
            $rsKeluar = DB::table('barang_keluar')
                ->join('barang as b', 'barang_keluar.barang_id', '=', 'b.id') // Join dengan tabel barang
                ->join('kategori as k', 'b.kategori_id', '=', 'k.id') // Join ke tabel kategori berdasarkan kategori di barang
                ->select(
                    'barang_keluar.id',
                    'k.deskripsi as kategori',
                    'b.merk',    // Ambil kolom merk dari tabel barang
                    'b.seri',    // Ambil kolom seri dari tabel barang
                    'barang_keluar.tgl_keluar',  // Ganti ke tgl_keluar
                    'barang_keluar.qty_keluar'   // Ganti ke qty_keluar
                )
                ->paginate(10);
        }

        return view('backend.barang-keluar.index', compact('rsKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listBarang = BarangModel::select(DB::raw("CONCAT(merk, ' - ', seri)
        AS nama_barang"), 'id')->pluck('nama_barang', 'id');

        return view('backend.barang-keluar.create', compact('listBarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id'  // Foreign key validation
        ]);

        // Cek stok barang saat ini
        $barang = DB::table('barang')->where('id', $request->barang_id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan!');
        }

        // Cek apakah stok mencukupi untuk pengurangan
        if ($barang->stok < $request->qty_keluar) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
        }

        // Cek apakah data dengan barang_id, tgl_keluar, dan qty_keluar sudah ada
        $existingData = BarangKeluar::where('barang_id', $request->barang_id)
            ->where('tgl_keluar', $request->tgl_keluar)
            ->where('qty_keluar', $request->qty_keluar)
            ->first();

        // Jika ada data yang sama, hapus terlebih dahulu
        if ($existingData) {
            $existingData->delete();
        }

        // Setelah menghapus data duplikat, simpan data baru
        BarangKeluar::create([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        // Update stok di tabel barang berdasarkan barang_id
        // DB::table('barang')
        //     ->where('id', $request->barang_id)
        //     ->decrement('stok', $request->qty_keluar);  // Kurangi stok lewat qty_keluar ke stok

        // Redirect ke halaman index barang dengan pesan sukses
        return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsKeluar = DB::table('barang_keluar')
            ->join('barang as b', 'barang_keluar.barang_id', '=', 'b.id') // Use alias 'b' for barang
            ->select(
                'barang_keluar.id',
                'barang_keluar.tgl_keluar',
                'barang_keluar.qty_keluar',
                DB::raw('b.merk as merk'), // Alias as nama_barang
                DB::raw('b.seri as seri'), // Alias as seri_barang
                'b.spesifikasi',
                'b.stok',
                // 'b.keterangan' // Add other necessary fields here
            )
            ->where('barang_keluar.id', $id)
            ->first();

        return view('backend.barang-keluar.show', compact('rsKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the specific keluar record to be edited
        $rsKeluar= DB::table('barang_keluar')
            ->select('id', 'tgl_keluar', 'qty_keluar', 'barang_id')
            ->where('id', $id)
            ->first();

        // Retrieve all categories to populate the dropdown list
        $listBarang = BarangModel::select(DB::raw("CONCAT(merk, ' - ', seri)
        AS nama_barang"), 'id')->pluck('nama_barang', 'id');
        
        // Pass both the barang record and the list of categories to the view
        return view('backend.barang-keluar.edit', compact('rsKeluar', 'listBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Ambil data barang_keluar yang ingin diupdate
            $barangKeluar = DB::table('barang_keluar')->where('id', $id)->first();
            if (!$barangKeluar) {
                return redirect()->route('barang-keluar.index')->withErrors('Data barang keluar tidak ditemukan.');
            }

            // Ambil data barang terkait
            $barang = DB::table('barang')->where('id', $request->barang_id)->first();

            // Kembalikan stok barang ke kondisi sebelum entry ini (stok lama)
            $stokLama = $barang->stok + $barangKeluar->qty_keluar;

            // Update stok barang ke stok lama
            DB::table('barang')
                ->where('id', $request->barang_id)
                ->update(['stok' => $stokLama]);

            // Jika ada perubahan pada qty_keluar, hitung stok baru
            // if ($barangKeluar->qty_keluar !== $request->qty_keluar) {
            //     // Hitung stok baru setelah perubahan
            //     $stokBaru = $stokLama - $request->qty_keluar;

            //     // Pastikan stok baru tidak negatif
            //     if ($stokBaru < 0) {
            //         return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
            //     }

            //     // Update stok barang dengan stok baru
            //     DB::table('barang')
            //         ->where('id', $request->barang_id)
            //         ->update(['stok' => $stokBaru]);
            // }

            // Update data barang_keluar dengan data baru
            DB::table('barang_keluar')
                ->where('id', $id)
                ->update([
                    'tgl_keluar' => $request->tgl_keluar,
                    'qty_keluar' => $request->qty_keluar,
                    'barang_id' => $request->barang_id,
                ]);

            // Commit transaksi
            DB::commit();

            return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil Diupdate!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->route('barang-keluar.index')->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data barang berdasarkan ID
        DB::table('barang_keluar')->where('id', $id)->delete();

        // Resequencing semua ID yang ada agar berurutan kembali tanpa celah
        $rowKeluar = BarangKeluar::orderBy('id')->get();  // Ambil semua data barang yang tersisa
        $newId = 1;

        // Update ulang ID dari 1 ke seterusnya
        foreach ($rowKeluar as $item) {
            DB::table('barang_keluar')
                ->where('id', $item->id)
                ->update(['id' => $newId]); // Update ID menjadi urutan baru
            $newId++;
        }

        // Setelah semua ID diurutkan ulang, reset AUTO_INCREMENT agar sesuai dengan ID terakhir
        DB::statement('ALTER TABLE barang_keluar AUTO_INCREMENT = ' . ($newId));

        return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
