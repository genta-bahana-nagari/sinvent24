@extends('backend.layouts.adm_template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center my-4" style="color: black;">Laravel CRUD Barang Masuk | Edit</h3>

                <div class="card border-1 shadow-sm rounded">
                    <div class="card-body">
                        <h3>Edit Data Pemasukan</h3>
                        <br/>

                        <form action="{{ route('barang-masuk.update', $rsMasuk->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Input Tanggal Masuk -->
                            <div class="mb-3">
                                <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tgl_masuk" value="{{ old('tgl_masuk', $rsMasuk->tgl_masuk) }}">
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Jumlah Barang Masuk -->
                            <div class="mb-3">
                                <label for="qty_masuk" class="form-label">Jumlah Barang Masuk</label>
                                <input type="number" name="qty_masuk" class="form-control @error('qty_masuk') is-invalid @enderror" placeholder="Masukkan jumlah barang masuk" value="{{ old('qty_masuk', $rsMasuk->qty_masuk) }}">
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Pilih Barang -->
                            <div class="mb-3">
                                <label for="barang_id" class="form-label">Pilih Barang</label>
                                <select name="barang_id" class="form-select @error('barang_id') is-invalid @enderror">
                                    <option value="">Pilih Barang</option>
                                    @if(isset($listBarang) && count($listBarang) > 0)
                                        @foreach($listBarang as $key => $val)
                                            <option value="{{ $key }}" {{ old('barang_id', $rsMasuk->barang_id) == $key ? 'selected' : '' }}>{{ $val }}</option>
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

                            <!-- Buttons -->
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('barang-masuk.index') }}" class="btn btn-md btn-dark mb-3">CANCEL</a>
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
