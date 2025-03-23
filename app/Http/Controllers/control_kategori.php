<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\model_kategori;

class control_kategori extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) { // With search feature
            $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                        ->where('id', 'like', '%'.$request->search.'%')
                        ->orWhere('deskripsi', 'like', '%'.$request->search.'%')
                        ->orWhere('kategori', 'like', '%'.$request->search.'%')
                        ->paginate(10);
        } else {
            // Without search feature
            $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                        ->paginate(10);
        }

        // ID table control
        $maxId = DB::table('kategori')->max('id');    
        if ($maxId === null) {
            $maxId = 0;
        }
        DB::statement('ALTER TABLE kategori AUTO_INCREMENT = ' . ($maxId + 1));

        return view('frontend.kategori.index', compact('rsKategori'));
    }

    public function create()
    {
        $listKategori = array(''=>'Pilih Kategori',
                              'M'=>'Modal',
                              'A'=>'Alat',
                              'BHP'=>'Barang Habis Pakai',
                              'BTHP'=>'Barang Tidak Habis Pakai');

        return view('frontend.kategori.create', compact('listKategori'));
    }

    public function store(Request $request)
    {
        // Required validation
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);

        // Save the data record
        model_kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori
        ]);
        
        // Manage the ID records & auto-increment
        $maxID = DB::table('kategori')->max('id');
        if ($maxID === null) {
            $maxID = 0; // If the table is empty, set ID to 0
        }
        DB::statement('ALTER table kategori auto_increment = ' . ($maxID + 1));
        
        // Redirect to index page
        return redirect()->route('kategori.index')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id)
    {
        $rsKategori = DB::table('kategori')
                        ->select('id',
                                 'deskripsi',
                                 'kategori',
                                 DB::raw('ketKategori(kategori) as ket'))
                        ->where('id', $id) // Kondisi ID yang dipilih
                        ->first();
        
        return view('frontend.kategori.show', compact('rsKategori'));
    }

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
        $rsKategori = model_kategori::findOrFail($id);

        return view('frontend.kategori.edit', compact('rsKategori', 'listKategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'deskripsi'=>'required',
            'kategori'=>'required'
        ]);

        $rsetKategori = model_kategori::find($id);
        $rsetKategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(string $id)
    {
        // $rsetKategori = model_kategori::find($id);
        // $rsetKategori->delete();
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['gagal' => 'Data Gagal Dihapus! Data masih digunakan']);            
        } else {
        $rsetKategori = model_kategori::find($id);
        $rsetKategori->delete();
        }


        // Resequencing all ID's available
        $kategori = model_kategori::orderBy('id')->get();
        $newId = 1;

        foreach ($kategori as $item) {
            DB::table('kategori')
                ->where('id', $item->id)
                ->update(['id' => $newId]);
            $newId++;
        }
        DB::statement('ALTER TABLE kategori AUTO_INCREMENT = ' . ($newId));

        return redirect('/kategori')->with('success', 'Data Berhasil Dihapus!');
    }
}
