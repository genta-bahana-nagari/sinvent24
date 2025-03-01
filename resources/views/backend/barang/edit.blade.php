@extends('backend.layouts.adm_template')

@section('content')
    <!-- membuat container -->
    <div class="container">
        <!-- membuat row  -->
         <div class="row">
            <!-- membuat kolom -->
            <div class="col">
                <div>
                <h3 class="text-center my-4" style="color: black; font-weight: 750;">Barang | Edit Data</h3>
                </div>
                <!-- membuat card  -->
                <div class="card border-1 shadow-sm rounded">
                    <div class="card-body">
                        
                        <div class="col6">
                            <h3>Edit Data Barang</h3>
                        </div>
                        
                        <br/>

                        <form action="{{ route('barang.update', $rsBarang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Input merk -->
                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" id="merk" placeholder="Masukkan merk barang" value="{{ $rsBarang->merk }}">
                            @error('merk')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Input seri -->
                        <div class="mb-3">
                            <label for="seri" class="form-label">Seri</label>
                            <input type="text" name="seri" class="form-control @error('seri') is-invalid @enderror" id="seri" placeholder="Masukkan seri barang" value="{{ $rsBarang->seri }}">
                            @error('seri')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Input spesifikasi -->
                        <div class="mb-3">
                            <label for="spesifikasi" class="form-label">Spesifikasi</label>
                            <input type="text" name="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror" id="spesifikasi" placeholder="Masukkan spesifikasi barang" value="{{ $rsBarang->spesifikasi }}">
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

                        <!-- Input kategori -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Data Terkait dari Tabel Kategori</label>
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

                            <!-- Buttons -->
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-md btn-primary me-3" style="opacity: 0.75;">UPDATE</button>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('barang.index') }}" class="btn btn-md btn-dark mb-3" style="opacity: 0.75;">CANCEL</a>
                                </div>
                            </div>
                        </form>
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
