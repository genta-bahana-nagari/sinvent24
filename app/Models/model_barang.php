<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_barang extends Model
{
    use HasFactory;
    
    protected $table = 'barang';
    protected $fillable = ['merk','seri','spesifikasi','gambar','kategori_id'];

    public function kategori() {
        return $this->belongsTo(model_kategori::class);
    }

    public function barang_masuk() {
        return $this->hasMany(model_masuk::class);
    }
    
    public function barang_keluar() {
        return $this->hasMany(model_keluar::class);
    }
}
