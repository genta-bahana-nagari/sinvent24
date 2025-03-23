<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_keluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = ['tgl_keluar', 'qty_keluar', 'barang_id'];

    public function barang()
    {
        return $this->belongsTo(model_barang::class, 'barang_id');
    }
}
