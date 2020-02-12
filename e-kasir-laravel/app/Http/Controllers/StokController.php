<?php

namespace App\Http\Controllers;

use App\StokModel;
use App\BarangModel;
use Illuminate\Http\Request;
use Validator;
use DB;
use PDF;
use File;
use App\Picqer\src\BarcodeGeneratorHTML;

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
                'harga_jual' => $request->harga_jual,
                'status' => 'aktif'
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
            'harga_jual' => $request->harga_jual,
            'status' => 'aktif'

        ]);

        return redirect('/liststok_pemilik')->with('success', ' ');
    }


    public function print_barcode(Request $request)
    {
        // dd($request->id);
        $id_stok = $request->id;
        $nama_barang = $request->nama;
        $jumlah = $request->jumlah;
        // dd($nama_barang);
        // dd($id_stok);
        return view('fol-join.printable_barcode',compact('id_stok','nama_barang','jumlah'));
        // $barcode = PDF::loadview('fol-join.printable_barcode',['id_stok'=>$request->id]);
        // return $barcode->download("barcode-$request->id");
        // return $barcode->stream();

    }

    }
