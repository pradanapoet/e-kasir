<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table ='transaksi';
    protected $fillable = ['tgl','total','tunai'];
    protected $primaryKey = 'id_transaksi';
}
