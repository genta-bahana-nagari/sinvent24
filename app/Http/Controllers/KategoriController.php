<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriModel;

class KategoriController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        //search
        if ($request->has('search')) {
            // Query untuk mencari berdasarkan id, deskripsi, atau kategori
            $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                        ->where('id', 'like', '%'.$request->search.'%')
                        ->orWhere('deskripsi', 'like', '%'.$request->search.'%')
                        ->orWhere('kategori', 'like', '%'.$request->search.'%')
                        ->paginate(10);
        } else {
            // Query tanpa pencarian, untuk menampilkan semua data kategori
            $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                        ->paginate(10);
        }

        $maxId = DB::table('kategori')->max('id');
        
        if ($maxId === null) {
            $maxId = 0; // Jika tabel kosong, set maxId ke 0
        }
    
        // Set AUTO_INCREMENT ke nilai yang lebih tinggi dari id terakhir
        DB::statement('ALTER TABLE kategori AUTO_INCREMENT = ' . ($maxId + 1));

        // Mengirim data ke view kategori.index
        return view('backend.kategori.index', compact('rsKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listKategori = [
            '' => 'Pilih Kategori',
            'M' => 'Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        ];
        
        return view('backend.kategori.create', compact('listKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori'  => 'required'
        ]);
    
        // Menggunakan KategoriModel untuk menyimpan data baru
        KategoriModel::create([
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori
        ]);
    
        //Resquence ID agar tetap urut setelah entry baru
        // Ambil nilai maksimum id yang tersisa
        $maxId = DB::table('kategori')->max('id');
        
        if ($maxId === null) {
            $maxId = 0; // Jika tabel kosong, set maxId ke 0
        }
    
        // Set AUTO_INCREMENT ke nilai yang lebih tinggi dari id terakhir
        DB::statement('ALTER TABLE kategori AUTO_INCREMENT = ' . ($maxId + 1));
    
        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    // Mengambil satu entri berdasarkan ID
    $rsKategori = DB::table('kategori')
                    ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                    ->where('id', $id)
                    ->first(); // Mengambil satu object

    return view('backend.kategori.show', compact('rsKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listKategori = [
            '' => 'Pilih Kategori',
            'M' => 'Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        ];

        // Menggunakan KategoriModel untuk menemukan data berdasarkan id
        $rsKategori = KategoriModel::findOrFail($id);

        return view('backend.kategori.edit', compact('rsKategori', 'listKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori'  => 'required'
        ]);

        $rsetKategori = KategoriModel::findOrFail($id);
        $rsetKategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['gagal' => 'Data Gagal Dihapus! Data masih digunakan']);            
        } else {
        $rsetKategori = KategoriModel::find($id);
        $rsetKategori->delete();
        }

    // Resequencing semua ID yang ada agar berurutan kembali tanpa celah
    $kategori = KategoriModel::orderBy('id')->get();  // Ambil semua data kategori yang tersisa
    $newId = 1;

    // Update ulang ID dari 1 ke seterusnya
    foreach ($kategori as $item) {
        DB::table('kategori')
            ->where('id', $item->id)
            ->update(['id' => $newId]); // Update ID menjadi urutan baru
        $newId++;
    }

    // Setelah semua ID diurutkan ulang, reset AUTO_INCREMENT agar sesuai dengan ID terakhir
    DB::statement('ALTER TABLE kategori AUTO_INCREMENT = ' . ($newId));

    return redirect('/kategori')->with('success', 'Data Berhasil Dihapus!');
    }
}