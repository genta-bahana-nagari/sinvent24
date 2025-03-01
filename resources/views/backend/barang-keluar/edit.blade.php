@extends('backend.layouts.adm_template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
            <h3 class="text-center my-4" style="color: black; font-weight: 750;">Barang Keluar | Edit Data</h3>
                <div class="card border-1 shadow-sm rounded">
                    <div class="card-body">
                        <div class="mb-3">
                            <h4>Edit Data Pengeluaran</h4>
                        </div>
                        <!-- Notifikasi Flash -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('barang-keluar.update', $rsKeluar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Input Tanggal Masuk -->
                            <div class="mb-3">
                                <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                                <input type="date" class="form-control" name="tgl_keluar" value="{{ old('tgl_keluar', $rsKeluar->tgl_keluar) }}">
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Jumlah Barang Masuk -->
                            <div class="mb-3">
                                <label for="qty_keluar" class="form-label">Jumlah Barang Keluar</label>
                                <input type="number" name="qty_keluar" class="form-control @error('qty_keluar') is-invalid @enderror"
                                placeholder="Masukkan jumlah barang masuk" value="{{ old('qty_keluar', $rsKeluar->qty_keluar) }}">
                                @error('qty_keluar')
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
                                            <option value="{{ $key }}" {{ old('barang_id', $rsKeluar->barang_id) == $key ? 'selected' : '' }}>{{ $val }}</option>
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
                                    <button type="submit" class="btn btn-md btn-primary me-3" style="opacity: 0.75;">UPDATE</button>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('barang-keluar.index') }}" class="btn btn-md btn-dark mb-3" style="opacity: 0.75;">CANCEL</a>
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
