<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriModel;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fol-kasir.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kategori()
    {
        $kategori = KategoriModel::all();
        return view('fol-join.category',compact('kategori'));
    }
    public function listbarang()
    {
        
        return view('fol-join.list_item');
    }
    public function liststok()
    {
        return view('fol-join.list_stock_item');
    }
    public function laporan_penjualan()
    {
        return view('fol-join.selling_report');
    }
    public function laporan_laba()
    {
        return view('fol-join.profit_report');
    }
    public function laporan_barang()
    {
        return view('fol-join.item_report');
    }
}
