<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiModel extends Model
{
    protected $table = 'detail_transaksi';
    protected $fillable = ['id_transaksi','id_stok','jumlah','harga','subtotal'];
    protected $primaryKey = 'id_detail';
}
