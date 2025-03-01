@extends('backend.layouts.adm_template')

@section('content')
<!-- Membuat container -->
<div class="container">
    <!-- Membuat row -->
    <div class="row">
        <!-- Membuat kolom -->
        <div class="col">
            <div>
            <h3 class="text-center my-4" style="color: black; font-weight: 750;">Barang Keluar | Entry Data</h3>
            </div>

            <!-- Membuat card -->
            <div class="card border-1 shadow-sm rounded">
                <div class="card-body">
                    <!-- Judul di dalam card -->
                    <div class="mb-3">
                        <h4>Entry Data Pengeluaran</h4>
                    </div>
                    <!-- Notifikasi Flash -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Form untuk entry data barang -->
                    <form action="{{ route('barang-keluar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Tanggal Keluar -->
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                                <input type="date" class="form-control " name="tgl_keluar" value="">
                            </div>
                            @error('tgl_keluar')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Worked input stok -->
                        <div class="mb-3">
                            <label for="qty_keluar" class="form-label">Jumlah Barang Keluar</label>
                            <input type="number" name="qty_keluar" class="form-control @error('qty_keluar') is-invalid @enderror" id="stok" placeholder="Masukkan jumlah barang masuk" value="{{ old('stok') }}">
                            @error('qty_keluar')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Input data barang  foreign -->
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">Pilih Barang</label>
                            <select name="barang_id" class="form-select @error('barang_id') is-invalid @enderror">
                                <option value="">Pilih Barang</option>
                                @if(isset($listBarang) && count($listBarang) > 0)
                                    @foreach($listBarang as $key => $val)
                                        <option value="{{ $key }}" {{ old('barang_id') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Tidak ada barang yang tersedia</option>
                                @endif
                            </select>
                            @error('barang_id')
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
                                <a href="{{ route('barang-keluar.index') }}" class="btn btn-md btn-success" style="opacity: 0.75;">
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