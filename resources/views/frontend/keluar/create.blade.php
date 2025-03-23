@extends('frontend.layout.layout-crud')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center py-3">Barang Keluar | Masukkan Data</h3>
    </div>
    <!-- Content -->
    <div class="card border-1 shadow-sm rounded">
        <div class="card-body">
            <div class="row my-2">
                <h3>Entry Barang Keluar Baru</h3>
            </div>
            <div class="row">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <form action="{{ route('keluar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Input merk -->
                    <div class="mb-3">
                        <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                        <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar') }}">
                        @error('tgl_keluar')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Worked input stok -->
                    <div class="mb-3">
                        <label for="qty_keluar" class="form-label">Jumlah Barang Keluar</label>
                        <input type="number" name="qty_keluar" class="form-control @error('qty_keluar') is-invalid @enderror" id="stok" placeholder="Masukkan jumlah barang keluar" value="{{ old('stok') }}">
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
                            <button type="submit" class="btn btn-md btn-primary">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('keluar.index') }}" class="btn btn-md btn-success">BACK</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
