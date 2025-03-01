@extends('backend.layouts.adm_template')

    @section('content')
    <div class="container-fluid">
        <div class="row text-center">
            <h1 style="font-size: 2em; font-weight: 500; margin-bottom: 20px;">
            Inventaris Kelompok 1 - 12 SIJA A</h1>
        </div>

        <div class="row text-center">
            <ul style="list-style-type: none; padding: 0; font-size: 1.2em;">
                <li style="margin-bottom: 3px;">Ade Rafif Daneswara (02)</li>
                <li style="margin-bottom: 3px;">Gabriel Possenti Genta (23)</li>
                <li style="margin-bottom: 3px;">Isnaini Nur Wahyuningsih (28)</li>
            </ul>
        </div>

        <div class="row text-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori</h5>
                        <p class="card-text">Jumlah kategori: {{ $jumlahKategori }}</p>
                        <hr>
                        <a href="{{ route('kategori.index') }}" class="btn" 
                        style="background-color: #89A8B2; opacity: 80%; color: white">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Barang</h5>
                        <p class="card-text">Jumlah barang: {{ $jumlahBarang }}</p>
                        <hr>
                        <a href="{{ route('barang.index') }}" class="btn" 
                        style="background-color: #89A8B2; opacity: 80%; color: white">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Barang Masuk</h5>
                        <p class="card-text">Jumlah pemasukan: {{ $jumlahMasuk }}</p>
                        <hr>
                        <a href="{{ route('barang-masuk.index') }}" class="btn" 
                        style="background-color: #89A8B2; opacity: 80%; color: white">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Barang Keluar</h5>
                        <p class="card-text">Jumlah pengeluaran: {{ $jumlahKeluar }}</p>
                        <hr>
                        <a href="{{ route('barang-keluar.index') }}" class="btn" 
                        style="background-color: #89A8B2; opacity: 80%; color: white">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
