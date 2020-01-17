<?php

namespace App\Http\Controllers;

use App\KategoriModel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KategoriModel::all();
        return view('fol-join.category',compact('kategori'));
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
     * @param  \App\KategoriModel  $kategoriModel
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriModel $kategoriModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KategoriModel  $kategoriModel
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriModel $kategoriModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KategoriModel  $kategoriModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriModel $kategoriModel)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KategoriModel::where('id_kategori', $request->id)
            ->update([
                'nama_kategori' => $request->nama_kategori
            ]);

        return redirect('/kategori_pemilik')->with('success_update', ' ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KategoriModel  $kategoriModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        KategoriModel::destroy($id);
        return redirect('/kategori_pemilik')->with('fail', ' ');
    }

    public function tambah_kategori(Request $request)
    {
        $this->validate($request,[
    		'nama_kategori' => 'required'
        ]);

        KategoriModel::create([
    		'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori_pemilik')->with('success', ' ');
    }
}
