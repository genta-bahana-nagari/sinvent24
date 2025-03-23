@extends('frontend.layout.layout-crud')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center py-3">Barang | Masukkan Data</h3>
    </div>
    <!-- Content -->
    <div class="card border-1 shadow-sm rounded">
        <div class="card-body">
            <div class="row my-2">
                <h3>Entry Barang Baru</h3>
            </div>
            <div class="row">
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="merk" 
                            class="form-control @error('merk') is-invalid @enderror" 
                            id="merk" placeholder="Merk" value="{{ old('merk') }}">
                        <label for="merk">Merk</label>
                        @error('merk')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="seri" 
                            class="form-control @error('seri') is-invalid @enderror" 
                            id="seri" placeholder="Seri" value="{{ old('seri') }}">
                        <label for="seri">Seri</label>
                        @error('seri')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="spesifikasi" 
                            class="form-control @error('spesifikasi') is-invalid @enderror" 
                            id="spesifikasi" placeholder="Spesifikasi">{{ old('spesifikasi') }}</textarea>
                        <label for="spesifikasi">Spesifikasi</label>
                        @error('spesifikasi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                        name="gambar">
                        @error('gambar')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="text" name="stok" class="form-control" id="stok" 
                            value="{{ old('stok', $rsBarang->stok ?? 0) }}" readonly>
                        <small class="text-muted">Stok bisa diatur di halaman barang-masuk dan barang-keluar</small>
                    </div>
                    @error('stok')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @if(isset($listKategori) && count($listKategori) > 0)
                                @foreach($listKategori as $key => $val)
                                    <option value="{{ $key }}" {{ old('kategori_id') == $key ? 'selected' : '' }}>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>Tidak ada kategori tersedia</option>
                            @endif
                        </select>
                        @error('kategori_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-md me-3">Simpan</button>
                            <button type="reset" class="btn btn-warning btn-md">Reset</button>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('barang.index') }}" class="btn btn-success btn-md">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
