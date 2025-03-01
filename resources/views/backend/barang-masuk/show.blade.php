@extends('backend.layouts.adm_template')

    @section('content')
    <!-- membuat container -->
    <div class="container">
        <!-- membuat row  -->
         <div class="row">
            <!-- membuat kolom -->
            <div class="col">
                <div>
                <h3 class="text-center my-4" style="color: black; font-weight: 750;">Barang Masuk | Detail</h3>
                </div>
                <!-- membuat card  -->
                <div class="card border-1 shadow-sm rounded">
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
                                    <td>{{ $rsMasuk->id }}</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsMasuk->merk }}</td>
                                </tr>
                                <tr>
                                    <td>Seri</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsMasuk->seri }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Barang Masuk</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsMasuk->tgl_masuk }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Barang Masuk</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsMasuk->qty_masuk }}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('barang-masuk.index') }}" class="btn btn-md btn-dark mb-3" 
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

    