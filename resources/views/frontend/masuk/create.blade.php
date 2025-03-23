@extends('frontend.layout.layout-crud')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center py-3">Barang Masuk | Masukkan Data</h3>
    </div>
    <!-- Content -->
    <div class="card border-1 shadow-sm rounded">
        <div class="card-body">
            <div class="row my-2">
                <h3>Entry Barang Masuk Baru</h3>
            </div>
            <div class="row">
                <form action="{{ route('masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Input merk -->
                    <div class="mb-3">
                            <div class="form-group">
                                <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control " name="tgl_masuk" value="">
                            </div>
                            @error('tgl_masuk')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Worked input stok -->
                        <div class="mb-3">
                            <label for="qty_masuk" class="form-label">Jumlah Barang Masuk</label>
                            <input type="number" name="qty_masuk" class="form-control @error('qty_masuk') is-invalid @enderror" id="stok" placeholder="Masukkan jumlah barang masuk" value="{{ old('stok') }}">
                            @error('qty_masuk')
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
                                <a href="{{ route('masuk.index') }}" class="btn btn-md btn-success">BACK</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
