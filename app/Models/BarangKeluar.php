<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    protected $fillable = [
        'tgl_keluar',
        'qty_keluar',
        'barang_id',  // Foreign key for category
    ];
}
