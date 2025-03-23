@extends('frontend.layout.layout-crud')

    @section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center py-3">Kategori | Detail Data</h3>
        </div>
        <!-- content -->
        <div class="card border-1 shadow-sm-rounded">
            <div class="card-body">
                <div class="row my-2">
                    <h3>Showing Details</h3>
                </div>
                <div class="row">
                    <table class="table table-hover">
                        <tr>
                            <td>ID</td>
                            <td>&nbsp;</td>
                            <td>{{ $rsKategori->id }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td></td>
                            <td>{{ $rsKategori->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td></td>
                            <td>{{ $rsKategori->kategori }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td></td>
                            <td>{{ $rsKategori->ket }}</td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col">
                        <a href="{{ route('kategori.index') }}" class="btn btn-md btn-dark mb-3">BACK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection