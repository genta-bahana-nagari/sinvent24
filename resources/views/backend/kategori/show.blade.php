@extends('backend.layouts.adm_template')

    @section('content')
    <!-- membuat container -->
    <div class="container">
        <!-- membuat row  -->
         <div class="row">
            <!-- membuat kolom -->
            <div class="col">
                <div>
                    <h3 class="text-center my-4" style="color: black; font-weight: 750;">Kategori | Detail</h3>
                </div>
                <!-- membuat card  -->
                <div class="card rounded" style="box-shadow: 1px 1px 2px #363535;">
                    <div class="card-body">
                        
                        <div class="col6">
                            <h3>Showing Details</h3>
                            
                        </div>
                                                
                        <br/>

                        <div class="row">
                            <div class="col">
                            <table class="table table-hover">
                                <tr>
                                    <td>ID</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategori->id }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategori->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategori->kategori }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategori->ket }}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-dark mb-3"
                            style="opacity: 0.75;">
                                <i class="fa fa-backward"></i>
                            </a>
                            </div>
                        </div>

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