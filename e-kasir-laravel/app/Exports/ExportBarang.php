<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportBarang implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')
        ->orderBy('stok.status')->get();
    }

    // public function view(): View
    // {
    //     $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')
    //     ->orderBy('stok.status')->get();
    //     return view('fol-join.item_report_print',compact('stok'));
    // }
}

class InvoicesExport implements FromView
{
    public function view(): View
    {
        return view('fol-join.item_report_print',compact('stok'));
    }
}

