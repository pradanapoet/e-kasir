<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama_barang','id_kategori','keterangan'];
    protected $primaryKey = 'id_barang';
}
