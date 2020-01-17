<?php

namespace App\Http\Controllers;

use App\BarangModel;
use App\KategoriModel;
use Illuminate\Http\Request;
use DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KategoriModel::all(); // buat dropdown select 
        $barangjoin = DB::table('barang')->join('kategori','barang.id_kategori','=','kategori.id_kategori')->get(); // buat tampil barang

        return view('fol-join.list_item',compact('kategori','barangjoin'));
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
     * @param  \App\BarangModel  $barangModel
     * @return \Illuminate\Http\Response
     */
    public function show(BarangModel $barangModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BarangModel  $barangModel
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangModel $barangModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BarangModel  $barangModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangModel $barangModel)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_kategori' => 'required'
        ]);

        BarangModel::where('id_barang', $request->id_barang)
            ->update([
                'nama_barang' => $request->nama_barang,
                'id_kategori' => $request->id_kategori,
                'keterangan' => $request->keterangan
            ]);

        return redirect('/listbarang_pemilik')->with('success_update', ' ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BarangModel  $barangModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        BarangModel::destroy($id);
        return redirect('/listbarang_pemilik')->with('fail', ' ');
    }

    public function tambah_barang(Request $request)
    {
        $this->validate($request,[
            'nama_barang' => 'required',
            'id_kategori' => 'required',
        ]);

        BarangModel::create([
    		'nama_barang' => $request->nama_barang,
            'id_kategori' =>  $request->id_kategori,
            'keterangan' => $request->keterangan

        ]);

        return redirect('/listbarang_pemilik')->with('success', ' ');
    }
}
