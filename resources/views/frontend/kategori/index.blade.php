@extends('frontend.layout.layout-crud')
    @section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center py-3">Kategori | Lihat Data</h3>
        </div>
        <!-- content -->
        <div class="card border-1 shadow-sm-rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="col text-end">
                        <form action="/kategori" method="GET">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari kategori" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Notification -->
                @if(session('gagal'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('gagal' )}}
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
                            <th>DESKRIPSI</th>
                            <th>KATEGORI</th>
                            <th>KETERANGAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rsKategori as $rowkategori)
                            <tr>
                                <td>{{ $rowkategori->id }}</td>
                                <td>{{ $rowkategori->deskripsi }}</td>
                                <td>{{ $rowkategori->kategori }}</td>
                                <td>{{ $rowkategori->ket }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $rowkategori->id) }}" method="POST">
                                        <a href="{{ route('kategori.show', $rowkategori->id) }}" class="btn btn-sm btn-dark">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('kategori.edit', $rowkategori->id) }}" class="btn btn-sm btn-primary">
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
                                    <div class="alert alert-warning text-center">Tidak ada data kategori</div>
                                </td>
                            </tr>
                    </tbody>    
                    @endforelse
                </table>
                {{ $rsKategori->links() }}
            </div>
        </div>
    </div>
    @endsection