@extends('frontend.layout.layout-crud')

    @section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center py-3">Ini adalah halaman Dashboard dari Sistem Inventaris</h3>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori</h5>
                        <p class="card-text">Jumlah kategori: {{ $jumlahKategori }}</p>
                        <hr>
                        <a href="{{ route('kategori.index') }}" class="btn btn-dark">Lihat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Barang</h5>
                        <p class="card-text">Jumlah barang: {{ $jumlahBarang }}</p>
                        <hr>
                        <a href="{{ route('barang.index') }}" class="btn btn-dark">Lihat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Barang Masuk</h5>
                        <p class="card-text">Jumlah pemasukan: {{ $jumlahMasuk }}</p>
                        <hr>
                        <a href="{{ route('masuk.index') }}" class="btn btn-dark">Lihat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Barang Keluar</h5>
                        <p class="card-text">Jumlah pengeluaran: {{ $jumlahKeluar }}</p>
                        <hr>
                        <a href="{{ route('keluar.index') }}" class="btn btn-dark">Lihat</a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    @endsection