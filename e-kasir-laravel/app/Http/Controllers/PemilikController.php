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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = CategoryModel::find($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        CategoryModel::destroy($id);
        return redirect('/kategori_pemilik')->with('fail', ' ');
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

        return redirect('/kategori_pemilik')->with('success', ' ');
    }


    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(CategoryModel  $kat)
    // {
    //     return view('fol-join.category_edit',compact('kat'));
    // }
}
