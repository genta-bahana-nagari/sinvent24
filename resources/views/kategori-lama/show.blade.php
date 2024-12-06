<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD KategoriController | Show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <!-- membuat container -->
    <div class="container">
        <!-- membuat row  -->
         <div class="row">
            <!-- membuat kolom -->
            <div class="col">
                <div>
                    <h3 class="text-center my-4" style="color: black;">Laravel CRUD KategoriController | Genta XII SIJA A</h3>
                </div>
                <!-- membuat card  -->
                <div class="card border-1 shadow-sm rounded">
                    <div class="card-body">
                        
                        <div class="col6">
                            <h3>Show KategoriController</h3>
                            
                        </div>
                                                
                        <br/>

                        <div class="row">
                            <div class="col">
                            <table class="table table-hover">
                                <tr>
                                    <td>ID</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategoriController->id }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategoriController->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <td>KategoriController</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategoriController->KategoriController }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>&nbsp;</td>
                                    <td>{{ $rsKategoriController->ket }}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('KategoriController.index') }}" class="btn btn-md btn-dark mb-3">BACK</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>