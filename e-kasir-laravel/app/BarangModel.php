<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StokModel;
use App\BarangModel;
class BarangModel extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama_barang','id_kategori','keterangan'];
    protected $primaryKey = 'id_barang';

    public function barang()
    {
        return $this->hasMany('App\StokModel');
    }
    //     public function stok()
    // {
    //     return $this->belongsTo('App\BarangModel');
    // }
}
