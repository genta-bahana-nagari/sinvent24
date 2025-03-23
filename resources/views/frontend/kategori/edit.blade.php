@extends('frontend.layout.layout-crud')

    @section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center py-3">Kategori | Edit Data</h3>
        </div>
        <!-- content -->
        <div class="card border-1 shadow-sm-rounded">
            <div class="card-body">
                <div class="row my-2">
                    <h3>Ubah Data Kategori</h3>
                </div>
                <div class="row">
                    <form action="{{ route('kategori.update', $rsKategori->id) }}" method="POST"
                    enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-floating">
                            <input type="text" name="deskripsi"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            id="floatingPassword" placeholder="Deskripsi"
                            value="{{old('deskripsi',$rsKategori->deskripsi)}}">
                            <label for="floatingPassword">Deskripsi</label>
                        </div>

                        @error('deskripsi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <div>
                            <select name="kategori"
                            class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example">
                                @foreach($listKategori as $key=>$val)
                                    @if($key==$rsKategori->kategori)
                                        <option selected value="{{$key}}">{{ $val }}</option>
                                    @else
                                        <option value="{{$key}}">{{ $val }}</option>
                                    @endif
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
                                <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('kategori.index') }}" class="btn btn-md btn-dark mb-3">CANCEL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection