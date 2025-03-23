@extends('frontend.layout.layout-crud')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center py-3">Barang Keluar | Detail Data</h3>
    </div>
    <!-- Content -->
    <div class="card border-1 shadow-sm rounded">
        <div class="card-body">
            <div class="row my-2">
                <h3>Lihat Data Barang Keluar</h3>
            </div>
            <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <tr>
                        <td>ID</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsKeluar->id }}</td>
                    </tr>
                    <tr>
                        <td>Merk</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsKeluar->merk }}</td>
                    </tr>
                    <tr>
                        <td>Seri</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsKeluar->seri }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Barang Keluar</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsKeluar->tgl_keluar }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang Keluar</td>
                        <td>&nbsp;</td>
                        <td>{{ $rsKeluar->qty_keluar }}</td>
                    </tr>
                </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <a href="{{ route('keluar.index') }}" class="btn btn-md btn-dark mb-3">BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
