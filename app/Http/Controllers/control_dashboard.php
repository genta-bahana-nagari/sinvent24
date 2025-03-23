<?php

namespace App\Http\Controllers;

use App\Models\model_keluar;
use App\Models\model_masuk;
use App\Models\model_barang; 
use App\Models\model_kategori;   

class control_dashboard extends Controller
{
    public function index()
    {
        $jumlahKategori = model_kategori::count();
        $jumlahBarang = model_barang::count();
        $jumlahMasuk = model_masuk::count();
        $jumlahKeluar = model_keluar::count();

        // Kirim data ke view
        return view('frontend.dashboard.index', compact('jumlahKategori', 'jumlahBarang', 'jumlahMasuk', 'jumlahKeluar'));
    }
}