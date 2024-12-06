<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\KategoriModel; 
use App\Models\BarangModel;   

class DashboardController extends Controller
{
    public function index()
    {
        // // Fetch all categories and items
        // $rsKategori = KategoriModel::all();
        // $rsBarang = BarangModel::all();
        // $rsMasuk = BarangMasuk::all();
        // $rsKeluar = BarangKeluar::all();

        // // Pass data to the view
        // return view('backend.dashboard.index', compact('rsKategori', 'rsBarang', 'rsMasuk', 'rsKeluar'));
        // Hitung jumlah data di masing-masing tabel
        $jumlahKategori = KategoriModel::count();
        $jumlahBarang = BarangModel::count();
        $jumlahMasuk = BarangMasuk::count();
        $jumlahKeluar = BarangKeluar::count();

        // Kirim data ke view
        return view('backend.dashboard.index', compact('jumlahKategori', 'jumlahBarang', 'jumlahMasuk', 'jumlahKeluar'));
    }
}
