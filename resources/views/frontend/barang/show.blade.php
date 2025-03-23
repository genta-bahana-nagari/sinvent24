@extends('frontend.layout.layout-crud')

    @section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center py-3">Barang | Detail Data</h3>
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
                            <td>{{ $rsBarang->id }}</td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td></td>
                            <td>{{ $rsBarang->merk }}</td>
                        </tr>
                        <tr>
                            <td>Seri</td>
                            <td></td>
                            <td>{{ $rsBarang->seri }}</td>
                        </tr>
                        <tr>
                            <td>Spesifikasi</td>
                            <td></td>
                            <td>{{ $rsBarang->spesifikasi }}</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td></td>
                            <td>{{ $rsBarang->stok }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td></td>
                            <td>{{ $rsBarang->kategori }}</td>
                        </tr>
                        <tr>
                            <td>Gambar</td>
                            <td></td>
                            <td class="text-center">
                            <img src="{{ asset('storage/' . $rsBarang->gambar) }}"
                            class="rounded" style="width: 250px" alt="Gambar Barang">
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col">
                        <a href="{{ route('barang.index') }}" class="btn btn-md btn-dark mb-3">BACK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection