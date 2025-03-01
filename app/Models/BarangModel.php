<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;
    // menambahkan identitas table yang diakses
    protected $table = 'barang';

    protected $fillable = [
        'merk',
        'seri',
        'spesifikasi',
        'stok',
        'kategori_id',  // Foreign key for category
    ];
   
}
