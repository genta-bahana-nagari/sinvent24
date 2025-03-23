@extends('frontend.layout.layout-crud')
    @section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center py-3">Barang Masuk | Lihat Data</h3>
        </div>

        <div class="card border-1 shadow-sm-rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('masuk.create') }}" class="btn btn-md btn-success mb-3">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="col text-end">
                        <form action="/masuk" method="GET">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari pemasukan" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error' )}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success' )}}
                    </div>
                @endif
                
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
                                <td>{{ $rowMasuk->merk }}</td>
                                <td>{{ $rowMasuk->seri }}</td>
                                <td>{{ $rowMasuk->tgl_masuk }}</td>
                                <td>{{ $rowMasuk->qty_masuk }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('masuk.destroy', $rowMasuk->id) }}" method="POST">
                                        <a href="{{ route('masuk.show', $rowMasuk->id) }}" class="btn btn-sm btn-dark">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('masuk.edit', $rowMasuk->id) }}" class="btn btn-sm btn-primary">
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
                    </tbody>    
                    @endforelse
                </table>
                {{ $rsMasuk->links() }}
            </div>
        </div>
    </div>
    @endsection