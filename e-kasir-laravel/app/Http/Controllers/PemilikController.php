<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CategoryModel;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fol-pemilik.index');
    }
    public function kategori()
    {
        $kategori = CategoryModel::all();
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
    public function tambah_kategori(Request $request)
    {
        $this->validate($request,[
    		'nama_kategori' => 'required'
        ]);
        
        CategoryModel::create([
    		'nama_kategori' => $request->nama_kategori
        ]);
        
        return redirect('/kategori_pemilik');
    }


}
