@extends('frontend.layout.layout-crud')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center py-3">Barang Masuk | Detail Data</h3>
    </div>
    <!-- Content -->
    <div class="card border-1 shadow-sm rounded">
        <div class="card-body">
            <div class="row my-2">
                <h3>Lihat Data Barang Masuk</h3>
            </div>
            <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <tr>
                        <td>ID</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsMasuk->id }}</td>
                    </tr>
                    <tr>
                        <td>Merk</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsMasuk->merk }}</td>
                    </tr>
                    <tr>
                        <td>Seri</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsMasuk->seri }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Barang Masuk</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsMasuk->tgl_masuk }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang Masuk</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsMasuk->qty_masuk }}</td>
                    </tr>
                </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <a href="{{ route('masuk.index') }}" class="btn btn-md btn-dark mb-3">BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
