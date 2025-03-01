@extends('backend.layouts.adm_template')

@section('content')
<!-- Membuat container -->
<div class="container">
    <!-- Membuat row -->
    <div class="row">
        <!-- Membuat kolom -->
        <div class="col">
            <div>
            <h3 class="text-center my-4" style="color: black; font-weight: 750;">Barang | Entry</h3>
            </div>

            <!-- Membuat card -->
            <div class="card border-1 shadow-sm rounded">
                <div class="card-body">
                    <!-- Judul di dalam card -->
                    <div class="mb-3">
                        <h4>Entry Data Barang</h4>
                    </div>

                    <!-- Form untuk entry data barang -->
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input merk -->
                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" id="merk" placeholder="Masukkan merk barang" value="{{ old('merk') }}">
                            @error('merk')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Input seri -->
                        <div class="mb-3">
                            <label for="seri" class="form-label">Seri</label>
                            <input type="text" name="seri" class="form-control @error('seri') is-invalid @enderror" id="seri" placeholder="Masukkan seri barang" value="{{ old('seri') }}">
                            @error('seri')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Input spesifikasi -->
                        <div class="mb-3">
                            <label for="spesifikasi" class="form-label">Spesifikasi</label>
                            <input type="text" name="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror" id="spesifikasi" placeholder="Masukkan spesifikasi barang" value="{{ old('spesifikasi') }}">
                            @error('spesifikasi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Locked input stok -->
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input name="stok" class="form-control" id="stok" value="{{ old('stok', $rsBarang->stok ?? 0) }}" readonly>
                            <small class="text-muted">Stok bisa diatur di halaman barang-masuk dan barang-keluar</small>
                        </div>
                        <!-- Worked input stok -->
                        <!-- <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" id="stok" placeholder="Masukkan jumlah stok" value="{{ old('stok') }}">
                            @error('stok')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> -->

                        <!-- Input kategori -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Data terkait dari tabel kategori</label>
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                <option value="">Pilih Data</option>
                                @if(isset($listKategori) && count($listKategori) > 0)
                                    @foreach($listKategori as $key => $val)
                                        <option value="{{ $key }}" {{ old('kategori_id') == $key ? 'selected' : '' }}>{{ $val }}</option>
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

                        <!-- Tombol submit dan reset -->
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-md btn-primary" style="opacity: 0.75;">SAVE</button>
                                <button type="reset" class="btn btn-md btn-warning" style="opacity: 0.75;">RESET</button>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('barang.index') }}" class="btn btn-md btn-success" style="opacity: 0.75;">
                                <i class="fa fa-backward"></i>
                            </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Akhir card -->
        </div>
        <!-- Akhir kolom -->
    </div>
    <!-- Akhir row -->
</div>
<!-- Akhir container -->
@endsection