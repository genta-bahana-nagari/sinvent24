@extends('backend.layouts.adm_template')

    @section('content')
    <!-- membuat container -->
    <div class="container">
        <!-- membuat row  -->
         <div class="row">
            <!-- membuat kolom -->
            <div class="col">
                <div>
                    <h3 class="text-center my-4" style="color: black; font-weight: 750;">Kategori | Edit Data</h3>
                </div>

                <!-- membuat card  -->
                <div class="card rounded" style="box-shadow: 1px 1px 2px #363535;">
                    <div class="card-body">
                        
                        <div class="col6">
                            <h3>Edit Kategori</h3>
                            
                        </div>
                        
                        <br/>

                        <form action="{{ route('kategori.update',$rsKategori->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-floating">
                                <input type="text" name="deskripsi" class="form-control" id="floatingPassword" placeholder="Deskripsi" value="{{old('deskripsi',$rsKategori->deskripsi)}}">
                                <label for="floatingPassword">Deskripsi</label>
                            </div>

                            @error('deskripsi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <br/>

                            <div>
                                <select name="kategori" class="form-select" aria-label="Default select example">
                                    @foreach($listKategori as $key=>$val)
                                        @if($key==$rsKategori->kategori)
                                            <option selected value={{$key}}>{{ $val }}</option>
                                        @else
                                            <option value={{$key}}>{{ $val }}</option>
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
                                    <button type="submit" class="btn btn-md btn-primary me-3"
                                    style="opacity: 0.75;">UPDATE</button>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('kategori.index') }}" class="btn btn-md btn-dark mb-3"
                                    style="opacity: 0.75;">CANCEL</a>
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

    