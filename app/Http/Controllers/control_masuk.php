<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\model_masuk;
use App\Models\model_barang;

class control_masuk extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $rsMasuk = DB::table('barang_masuk')
                ->join('barang as b', 'barang_masuk.barang_id', '=', 'b.id') // Join dengan tabel barang
                ->join('kategori as k', 'b.kategori_id', '=', 'k.id') // Join ke tabel kategori berdasarkan kategori di barang
                ->select(
                    'barang_masuk.id',
                    'k.deskripsi as kategori',
                    'b.merk',    // Ambil kolom merk dari tabel barang
                    'b.seri',    // Ambil kolom seri dari tabel barang
                    'barang_masuk.tgl_masuk',
                    'barang_masuk.qty_masuk'
                )
                ->where('barang_masuk.id', 'like', '%' . $request->search . '%')
                ->orWhere('b.merk', 'like', '%' . $request->search . '%') // Search based on merk
                ->paginate(10);
        } else {
            $rsMasuk = DB::table('barang_masuk')
                ->join('barang as b', 'barang_masuk.barang_id', '=', 'b.id') // Join dengan tabel barang
                ->join('kategori as k', 'b.kategori_id', '=', 'k.id') // Join ke tabel kategori berdasarkan kategori di barang
                ->select(
                    'barang_masuk.id',
                    'k.deskripsi as kategori',
                    'b.merk',    // Ambil kolom merk dari tabel barang
                    'b.seri',    // Ambil kolom seri dari tabel barang
                    'barang_masuk.tgl_masuk',
                    'barang_masuk.qty_masuk'
                )
                ->paginate(10);
        }

        return view('frontend.masuk.index', compact('rsMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listBarang = model_barang::select(DB::raw("CONCAT(merk, ' - ', seri) AS nama_barang"), 'id')->pluck('nama_barang', 'id');

        return view('frontend.masuk.create', compact('listBarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required',
            'barang_id' => 'required|exists:barang,id'  // Foreign key validation
        ]);

        // Cek apakah data dengan barang_id, merk, dan seri sudah ada
        $existingData = model_masuk::where('barang_id', $request->barang_id)
            ->where('tgl_masuk', $request->tgl_masuk)
            ->where('qty_masuk', $request->qty_masuk)
            ->first();

        // Jika ada data yang sama, hapus terlebih dahulu
        if ($existingData) {
            $existingData->delete();
        }

        // Setelah menghapus data duplikat, simpan data baru
        model_masuk::create([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);

        DB::table('barang')
        ->where('id', $request->barang_id)
        ->increment('stok', $request->qty_masuk);

        // Redirect ke halaman index barang dengan pesan sukses
        return redirect()->route('masuk.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsMasuk = DB::table('barang_masuk')
            ->join('barang as b', 'barang_masuk.barang_id', '=', 'b.id') // Use alias 'b' for barang
            ->select(
                'barang_masuk.id',
                'barang_masuk.tgl_masuk',
                'barang_masuk.qty_masuk',
                DB::raw('b.merk as merk'), // Alias as nama_barang
                DB::raw('b.seri as seri'), // Alias as seri_barang
                'b.spesifikasi',
                'b.stok',
                // 'b.keterangan' // Add other necessary fields here
            )
            ->where('barang_masuk.id', $id)
            ->first();

        return view('frontend.masuk.show', compact('rsMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the specific masuk record to be edited
        $rsMasuk= DB::table('barang_masuk')
            ->select('id', 'tgl_masuk', 'qty_masuk', 'barang_id')
            ->where('id', $id)
            ->first();

        // Retrieve all categories to populate the dropdown list
        $listBarang = model_barang::select(DB::raw("CONCAT(merk, ' - ', seri) AS nama_barang"), 'id')->pluck('nama_barang', 'id');
        
        // Pass both the barang record and the list of categories to the view
        return view('frontend.masuk.edit', compact('rsMasuk', 'listBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Ambil data barang_masuk yang ingin diupdate
            $barangMasuk = DB::table('barang_masuk')->where('id', $id)->first();
            if (!$barangMasuk) {
                return redirect()->route('masuk.index')->withErrors('Data barang masuk tidak ditemukan.');
            }

            // Ambil data barang terkait
            $barang = DB::table('barang')->where('id', $request->barang_id)->first();
            if (!$barang) {
                return redirect()->route('masuk.index')->withErrors('Barang tidak ditemukan.');
            }

            // **Mengembalikan stok barang ke kondisi sebelum entry ini** (stok lama)
            $stokLama = $barang->stok - $barangMasuk->qty_masuk;

            // Pastikan stok tidak menjadi negatif
            if ($stokLama < 0) {
                $stokLama = 0;
            }

            // Update stok barang ke stok lama
            DB::table('barang')
                ->where('id', $request->barang_id)
                ->update(['stok' => $stokLama]);

            // Cek jika ada perubahan tanggal atau jumlah barang masuk
            if ($barangMasuk->tgl_masuk !== $request->tgl_masuk || $barangMasuk->qty_masuk !== $request->qty_masuk) {

                // Update stok barang dengan stok baru (tambahkan qty_masuk yang baru)
                $stokBaru = $stokLama + $request->qty_masuk;

                DB::table('barang')
                    ->where('id', $request->barang_id)
                    ->update(['stok' => $stokBaru]);

                // Update data barang_masuk dengan data yang baru
                DB::table('barang_masuk')
                    ->where('id', $id)
                    ->update([
                        'tgl_masuk' => $request->tgl_masuk,
                        'qty_masuk' => $request->qty_masuk,
                        'barang_id' => $request->barang_id,
                    ]);
            }

            // Commit transaksi
            DB::commit();

            return redirect()->route('masuk.index')->with('success', 'Data Berhasil Diupdate!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->route('masuk.index')->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data barang berdasarkan ID
        DB::table('barang_masuk')->where('id', $id)->delete();

        // Resequencing semua ID yang ada agar berurutan kembali tanpa celah
        $rowMasuk = model_masuk::orderBy('id')->get();  // Ambil semua data barang yang tersisa
        $newId = 1;

        // Update ulang ID dari 1 ke seterusnya
        foreach ($rowMasuk as $item) {
            DB::table('barang_masuk')
                ->where('id', $item->id)
                ->update(['id' => $newId]); // Update ID menjadi urutan baru
            $newId++;
        }

        // Setelah semua ID diurutkan ulang, reset AUTO_INCREMENT agar sesuai dengan ID terakhir
        DB::statement('ALTER TABLE barang_masuk AUTO_INCREMENT = ' . ($newId));

        return redirect()->route('masuk.index')->with('success', 'Data Berhasil Dihapus!');
    }
}