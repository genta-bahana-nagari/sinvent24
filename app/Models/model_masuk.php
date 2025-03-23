<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_masuk extends Model
{
    use HasFactory;
    
    // Tanpa belongsTo
    protected $table = 'barang_masuk';
    protected $fillable = ['tgl_masuk', 'qty_masuk', 'barang_id'];

    public function barang()
    {
        return $this->belongsTo(model_barang::class, 'barang_id');
    }
}
