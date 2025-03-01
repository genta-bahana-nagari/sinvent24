@extends('backend.layouts.adm_template')

@section('content')
<!-- membuat container -->
<div class="container">
    <!-- membuat row  -->
    <div class="row">
        <!-- membuat kolom -->
        <div class="col">
            <div>
            <h3 class="text-center my-4" style="color: black; font-weight: 750;">Barang | Kelompok 1</h3>
            </div>

            <!-- membuat card  -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-3"
                                style="opacity: 0.75;">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col text-end">
                            <form action="/barang" method="GET"> <!-- Changed action from /KategoriController to /barang -->
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Barang" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                                </div>
                            </form>
                        </div>
                        <!-- Notifikasi Flash -->
                        @if(session('gagal'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('gagal') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        </div>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>KATEGORI</th>
                            <th>MERK</th>
                            <th>SERI</th>
                            <th>SPESIFIKASI</th>
                            <th>STOK</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rsBarang as $rowBarang)
                            <tr>
                                <td>{{ $rowBarang->id }}</td>
                                <td>{{ $rowBarang->kategori }}</td>
                                <td>{{ $rowBarang->merk }}</td>
                                <td>{{ $rowBarang->seri }}</td>
                                <td>{{ $rowBarang->spesifikasi }}</td>
                                <td>{{ $rowBarang->stok }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $rowBarang->id) }}" method="POST">
                                            <a href="{{ route('barang.show', $rowBarang->id) }}" class="btn btn-sm btn-dark" style="opacity: 0.75;">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('barang.edit', $rowBarang->id) }}" class="btn btn-sm btn-primary" style="opacity: 0.75;">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" style="opacity: 0.75;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-warning text-center">Tidak ada data barang</div>
                                        </td>
                                    </tr>
                                @endforelse
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $rsBarang->links() }}
                    </div>

                </div>
            </div>
            <!-- akhir card  -->
        </div>
        <!-- akhir kolom -->
    </div>
    <!-- akhir row -->
</div>
<!-- akhir container -->
@endsection