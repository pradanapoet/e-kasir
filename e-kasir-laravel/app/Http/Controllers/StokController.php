<?php

namespace App\Http\Controllers;

use App\StokModel;
use App\BarangModel;
use Illuminate\Http\Request;
use DB;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->get();
        $barang = BarangModel::all();
        return view('fol-join.list_stock_item',compact('stok','barang'));
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
     * @param  \App\StokModel  $stokModel
     * @return \Illuminate\Http\Response
     */
    public function show(StokModel $stokModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StokModel  $stokModel
     * @return \Illuminate\Http\Response
     */
    public function edit(StokModel $stokModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StokModel  $stokModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StokModel $stokModel)
    {
        $request->validate([
            'id_barang' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_stok_masuk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required'
        ]);

        StokModel::where('id_stok', $request->id_stok)
            ->update([
                'id_barang' => $request->id_barang,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
                'jumlah_stok_masuk' =>  $request->jumlah_stok_masuk,
                'sisa_stok' => $request->sisa_stok,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual
            ]);

        return redirect('/liststok_pemilik')->with('success_update', ' ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StokModel  $stokModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(StokModel $stokModel)
    {
        //
    }

    public function tambah_stok(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_stok_masuk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required'
        ]);

        StokModel::create([
            'id_barang' => $request->id_barang,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'jumlah_stok_masuk' =>  $request->jumlah_stok_masuk,
            'sisa_stok' => $request->jumlah_stok_masuk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual

        ]);

        return redirect('/liststok_pemilik')->with('success', ' ');
    }
}
