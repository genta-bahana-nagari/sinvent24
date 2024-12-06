<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    use HasFactory;
    //menambahkan identitas table yang diakses
    protected $table='kategori';
    //menambahkan mass assigmnet, daftar field yang dibuat CRUD
    protected $fillable = ['deskripsi','kategori'];
}
