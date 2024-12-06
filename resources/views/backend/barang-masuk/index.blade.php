@extends('backend.layouts.adm_template')

    @section('content')
        <!-- membuat container -->
        <div class="container">
            <!-- membuat row  -->
            <div class="row">
                <!-- membuat kolom -->
                <div class="col">
                    <div>
                        <h3 class="text-center my-4">Laravel CRUD Sinvent | Barang Masuk</h3>
                    </div>
                    <!-- membuat card  -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('barang-masuk.create') }}" class="btn btn-md btn-success mb-3">ENTRY</a>
                                </div>

                                <div class="col text-end">
                                    <form action="/barang-masuk" method="GET"> <!-- Changed action from /kategori to /barang -->
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
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>KATEGORI</th>
                                            <th>MERK</th>
                                            <th>SERI</th>
                                            <th>TANGGAL MASUK</th>
                                            <th>JUMLAH MASUK</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($rsMasuk as $rowMasuk)
                                        <tr>
                                            <td>{{ $rowMasuk->id }}</td>
                                            <td>{{ $rowMasuk->kategori }}</td>
                                            <td>{{ $rowMasuk->merk }}</td> <!-- Tampilkan Merk Barang -->
                                            <td>{{ $rowMasuk->seri }}</td> <!-- Tampilkan Seri Barang -->
                                            <td>{{ $rowMasuk->tgl_masuk }}</td>
                                            <td>{{ $rowMasuk->qty_masuk }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang-masuk.destroy', $rowMasuk->id) }}" method="POST">
                                                    <a href="{{ route('barang-masuk.show', $rowMasuk->id) }}" class="btn btn-sm btn-dark">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('barang-masuk.edit', $rowMasuk->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="alert alert-warning text-center">Tidak ada data pemasukan</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                            {{ $rsMasuk->links() }}
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