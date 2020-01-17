<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori'];
    protected $primaryKey = 'id_kategori';
}
