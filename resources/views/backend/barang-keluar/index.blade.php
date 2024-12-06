@extends('backend.layouts.adm_template')

    @section('content')
        <!-- membuat container -->
        <div class="container">
            <!-- membuat row  -->
            <div class="row">
                <!-- membuat kolom -->
                <div class="col">
                    <div>
                        <h3 class="text-center my-4">Laravel CRUD Sinvent | Barang Keluar</h3>
                    </div>
                    <!-- membuat card  -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('barang-keluar.create') }}" class="btn btn-md btn-success mb-3">ENTRY</a>
                                </div>
                                <div class="col text-end">
                                    <form action="/barang-keluar" method="GET"> <!-- Changed action from /kategori to /barang -->
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
                                        <th>TANGGAL KELUAR</th>
                                        <th>JUMLAH KELUAR</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($rsKeluar as $rowKeluar)
                                    <tr>
                                        <td>{{ $rowKeluar->id }}</td>
                                        <td>{{ $rowKeluar->kategori }}</td>
                                        <td>{{ $rowKeluar->merk }}</td> <!-- Tampilkan Merk Barang -->
                                        <td>{{ $rowKeluar->seri }}</td> <!-- Tampilkan Seri Barang -->
                                        <td>{{ $rowKeluar->tgl_keluar }}</td>
                                        <td>{{ $rowKeluar->qty_keluar }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang-keluar.destroy', $rowKeluar->id) }}" method="POST">
                                                <a href="{{ route('barang-keluar.show', $rowKeluar->id) }}" class="btn btn-sm btn-dark">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('barang-keluar.edit', $rowKeluar->id) }}" class="btn btn-sm btn-primary">
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
                                            <div class="alert alert-warning text-center">Tidak ada data pengeluaran</div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                            {{ $rsKeluar->links() }}
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