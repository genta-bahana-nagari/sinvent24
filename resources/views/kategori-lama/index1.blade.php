<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD KategoriController</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
    <!--Membuat sidebar dan navbar!-->
    
    <!-- membuat container -->
    <div class="container">
        <!-- membuat row  -->
         <div class="row">
            <!-- membuat kolom -->
            <div class="col">
                <div>
                    <h3 class="text-center my-4">Laravel CRUD KategoriController | Genta XII SIJA A</h3>
                </div>

                <!-- membuat card  -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('KategoriController.create') }}" class="btn btn-md btn-success mb-3">ENTRY</a>
                            </div>

                            <div class="col text-end">
                                <form action="/KategoriController" method="GET">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control" placeholder="Cari KategoriController" aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>DESKRIPSI</th>
                                    <th>KategoriController</th>
                                    <th>KETERANGAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rsKategoriController as $rowKategoriController)
                                    <tr>
                                        <td>{{ $rowKategoriController->id }}</td>
                                        <td>{{ $rowKategoriController->deskripsi }}</td>
                                        <td>{{ $rowKategoriController->KategoriController }}</td>
                                        <td>{{ $rowKategoriController->ket }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('KategoriController.destroy', $rowKategoriController->id) }}" method="POST">
                                                <a href="{{ route('KategoriController.show', $rowKategoriController->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('KategoriController.edit', $rowKategoriController->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                <div class="alert alert-warning text-center">Tidak Ada Data yang Ditemukan</div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $rsKategoriController->links() }}
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
