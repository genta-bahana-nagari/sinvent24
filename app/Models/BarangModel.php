<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'merk',
        'seri',
        'spesifikasi',
        'stok',
        'kategori_id',  // Foreign key for category
    ];

    // Define the relationship to the KategoriModel
    // public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class, 'kategori_id');
    // }
}
