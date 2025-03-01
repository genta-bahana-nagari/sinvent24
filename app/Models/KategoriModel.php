<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    // menambahkan mass assignment, daftar field yang dibibuat CRUD
    protected $fillable = ['deskripsi','kategori'];
}
