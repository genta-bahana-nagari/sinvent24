@forelse($rsKategoriController as $rowKategoriController)
    {{ $rowKategoriController->id }}
    {{ $rowKategoriController->deskripsi }}
    {{ $rowKategoriController->KategoriController }}

    <!-- ganti baris -->
    <br/> 
 @empty
    Recordset kosong
 @endforelse