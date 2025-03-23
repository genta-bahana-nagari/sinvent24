<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\model_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class control_barang extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) { // With search feature
            $rsBarang = DB::table('barang')
                ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                ->select(
                    'barang.id',
                    'barang.merk',
                    'barang.seri',
                    'barang.spesifikasi',
                    'barang.stok',
                    'kategori.deskripsi as kategori'
                )
                ->where('barang.id', 'like', '%' . $request->search . '%')
                ->orWhere('barang.merk', 'like', '%' . $request->search . '%')
                ->orWhere('barang.seri', 'like', '%' . $request->search . '%')
                ->orWhere('barang.spesifikasi', 'like', '%' . $request->search . '%')
                ->orWhere('barang.stok', 'like', '%' . $request->search . '%')
                ->orWhere('kategori.deskripsi', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            // Without search feature
            $rsBarang = DB::table('barang')
                ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                ->select(
                    'barang.id',
                    'barang.merk',
                    'barang.seri',
                    'barang.spesifikasi',
                    'barang.stok',
                    'kategori.deskripsi as kategori'
                )
                ->paginate(10);
        }

        return view('frontend.barang.index', compact('rsBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listKategori = DB::table('kategori')->pluck('deskripsi', 'id');

        return view('frontend.barang.create', compact('listKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Required validation
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        // Check existing data (avoid duplicates)
        $existingData = model_barang::where('kategori_id', $request->kategori_id)
            ->where('merk', $request->merk)
            ->where('seri', $request->seri)
            ->first();

        // Delete existing data if it matches
        if ($existingData) {
            if ($existingData->gambar) {
                Storage::disk('public')->delete($existingData->gambar);
            }
            $existingData->delete();
        }

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('images', 'public');
        }

        // Save the data record
        model_barang::create([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'gambar' => $imagePath,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('barang.index')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id)
    {
        $rsBarang = DB::table('barang')
            ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
            ->select(
                'barang.id',
                'barang.merk',
                'barang.seri',
                'barang.spesifikasi',
                'barang.gambar',
                'barang.stok',
                'kategori.deskripsi as kategori'
            )
            ->where('barang.id', $id)
            ->first();

        return view('frontend.barang.show', compact('rsBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsBarang = model_barang::findOrFail($id);
        $listKategori = DB::table('kategori')->pluck('deskripsi', 'id');

        return view('frontend.barang.edit', compact('rsBarang', 'listKategori'));
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
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        $barang = model_barang::findOrFail($id);

        // Jika tidak ada file baru yang diunggah
        if (!$request->hasFile('gambar')) {
            $barang->update([
                'merk' => $request->merk,
                'seri' => $request->seri,
                'spesifikasi' => $request->spesifikasi,
                'kategori_id' => $request->kategori_id,
            ]);
        } else {
            // Hapus gambar lama jika ada
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }

            // Simpan gambar baru dan dapatkan path-nya
            $imagePath = $request->file('gambar')->store('images', 'public');

            // Perbarui semua data
            $barang->update([
                'merk' => $request->merk,
                'seri' => $request->seri,
                'spesifikasi' => $request->spesifikasi,
                'gambar' => $imagePath,
                'kategori_id' => $request->kategori_id,
            ]);
        }

        return redirect()->route('barang.index')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang_masuk')->where('barang_id', $id)->exists()){
            return redirect()->route('barang.index')->with(['gagal' => 'Data Gagal Dihapus! Data masih digunakan']);            
        } else {
        $barang = model_barang::findOrFail($id);

        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();
        }

        // $barang = model_barang::findOrFail($id);

        // if ($barang->gambar) {
        //     Storage::disk('public')->delete($barang->gambar);
        // }

        // $barang->delete();

        $barang = model_barang::orderBy('id')->get();
        $newId = 1;

        foreach ($barang as $item) {
            DB::table('barang')
                ->where('id', $item->id)
                ->update(['id' => $newId]);
            $newId++;
        }
        DB::statement('ALTER TABLE barang AUTO_INCREMENT = ' . ($newId));

        return redirect()->route('barang.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
