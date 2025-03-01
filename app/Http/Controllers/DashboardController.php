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
        $jumlahKategori = KategoriModel::count();
        $jumlahBarang = BarangModel::count();
        $jumlahMasuk = BarangMasuk::count();
        $jumlahKeluar = BarangKeluar::count();

        return view('backend.dashboard.index', compact('jumlahKategori', 'jumlahBarang', 'jumlahMasuk', 'jumlahKeluar'));
    }
}
