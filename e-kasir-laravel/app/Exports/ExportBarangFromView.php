<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ExportBarangFromView implements FromView
{
    public function view(): View
    {
        $stok = DB::table('stok')
        ->join('barang','stok.id_barang','=','barang.id_barang')
        ->orderBy('stok.status')->get();
        return view('fol-join.item_report_print',compact('stok'));
    }
}

?>