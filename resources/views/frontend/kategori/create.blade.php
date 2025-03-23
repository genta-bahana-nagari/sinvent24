@extends('frontend.layout.layout-crud')

    @section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center py-3">Kategori | Masukkan Data</h3>
        </div>
        <!-- content -->
        <div class="card border-1 shadow-sm-rounded">
            <div class="card-body">
                <div class="row my-2">
                    <h3>Entry Data Baru</h3>
                </div>
                <div class="row">
                    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="deskripsi"
                        class="form-control @error('deskripsi') is-invalid-@enderror"
                        id="floatingPassword" placeholder="Deskripsi" value="{{old('deskripsi')}}">
                        <label for="floatingPassword">Deskripsi</label>
                        @error('deskripsi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <br>
                    <div>
                        <select name="kategori" class="form-select" aria-label="Default select example">
                            @foreach($listKategori as $key=>$val)
                                <option value={{$key}}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('kategori')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <br/>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-success mb-3">BACK</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection