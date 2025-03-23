<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\model_keluar;
use App\Models\model_barang;
use App\Models\model_masuk;

class control_keluar extends Controller
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

        return view('frontend.keluar.index', compact('rsKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listBarang = model_barang::select(DB::raw("CONCAT(merk, ' - ', seri)
        AS nama_barang"), 'id')->pluck('nama_barang', 'id');

        return view('frontend.keluar.create', compact('listBarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id'
        ]);

        // Ambil data barang berdasarkan barang_id
        $barang = DB::table('barang')->where('id', $request->barang_id)->first();

        // Debugging untuk cek data barang
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan!');
        }

        // Cek apakah stok cukup
        if ($barang->stok < $request->qty_keluar) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
        }

        // Simpan data ke database
        model_keluar::create([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        // Update stok di tabel barang berdasarkan barang_id
        DB::table('barang')
            ->where('id', $request->barang_id)
            ->decrement('stok', $request->qty_keluar);  // Kurangi stok lewat qty_keluar ke stok

        return redirect()->route('keluar.index')->with('success', 'Data Berhasil Disimpan!');
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

        return view('frontend.keluar.show', compact('rsKeluar'));
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
        $listBarang = model_barang::select(DB::raw("CONCAT(merk, ' - ', seri)
        AS nama_barang"), 'id')->pluck('nama_barang', 'id');
        
        // Pass both the barang record and the list of categories to the view
        return view('frontend.keluar.edit', compact('rsKeluar', 'listBarang'));
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

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Ambil data barang_keluar yang ingin diperbarui
            $barangKeluar = DB::table('barang_keluar')->where('id', $id)->first();
            if (!$barangKeluar) {
                return redirect()->route('keluar.index')->withErrors('Data barang keluar tidak ditemukan.');
            }

            // Ambil stok barang lama sebelum perubahan
            $barangLama = DB::table('barang')->where('id', $barangKeluar->barang_id)->first();
            if (!$barangLama) {
                return redirect()->route('keluar.index')->withErrors('Barang lama tidak ditemukan.');
            }

            // Kembalikan stok awal sebelum update
            DB::table('barang')
                ->where('id', $barangKeluar->barang_id)
                ->update(['stok' => $barangLama->stok + $barangKeluar->qty_keluar]);

            // Ambil kembali data barang untuk mendapatkan stok awal setelah reset
            $barangBaru = DB::table('barang')->where('id', $request->barang_id)->first();
            if (!$barangBaru) {
                return redirect()->route('keluar.index')->withErrors('Barang baru tidak ditemukan.');
            }

            // Hitung stok akhir setelah update
            $stokAkhir = $barangBaru->stok - $request->qty_keluar;

            // Cek apakah stok cukup setelah update
            if ($stokAkhir < 0) {
                DB::rollBack();
                return redirect()->route('keluar.index')->withErrors('Stok barang tidak mencukupi untuk pembaruan.');
            }

            // Perbarui stok barang baru
            DB::table('barang')
                ->where('id', $request->barang_id)
                ->update(['stok' => $stokAkhir]);

            // Update data barang_keluar dengan input terbaru
            DB::table('barang_keluar')
                ->where('id', $id)
                ->update([
                    'tgl_keluar' => $request->tgl_keluar,
                    'qty_keluar' => $request->qty_keluar,
                    'barang_id' => $request->barang_id,
                ]);

            // Commit transaksi
            DB::commit();

            return redirect()->route('keluar.index')->with('success', 'Data Berhasil Diupdate!');
        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();
            return redirect()->route('keluar.index')->withErrors('Terjadi kesalahan: ' . $e->getMessage());
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
        $rowKeluar = model_keluar::orderBy('id')->get();  // Ambil semua data barang yang tersisa
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

        return redirect()->route('keluar.index')->with('success', 'Data Berhasil Dihapus!');
    }
}