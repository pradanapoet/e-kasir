<?php

namespace App\Http\Controllers;

use App\POSModel;
use App\BarangModel;
use App\StokModel;
use Illuminate\Http\Request;
use DB;
use App\Post;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->get();
        return view('fol-join.pos',compact('stok'));
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
     * @param  \App\POSModel  $pOSModel
     * @return \Illuminate\Http\Response
     */
    public function show(POSModel $pOSModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\POSModel  $pOSModel
     * @return \Illuminate\Http\Response
     */
    public function edit(POSModel $pOSModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\POSModel  $pOSModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, POSModel $pOSModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\POSModel  $pOSModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(POSModel $pOSModel)
    {
        //
    }

    public function addToCart($id)
    {
        // $product = DB::table('stok')->get();

        $product = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->where('id_stok',$id)->get();
        // dd($product);
        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $id => [
                    "nama" => $product[0]->nama_barang,
                    "kuantitas" => 1,
                    "harga" => $product[0]->harga_jual,
                    "kadaluarsa" => $product[0]->tanggal_kadaluarsa

                ]
            ];

            session()->put('cart', $cart);

            $htmlCart = view('fol-layout.main')->render();

            return response()->json(['data' => $htmlCart]);
            return redirect('/pos');
            //return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['kuantitas']++;

            session()->put('cart', $cart);

            $htmlCart = view('fol-layout.main')->render();

            return response()->json(['data' => $htmlCart]);
            return redirect('/pos');
            //return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "nama" => $product[0]->nama_barang,
            "kuantitas" => 1,
            "harga" => $product[0]->harga_jual,
            "kadaluarsa" => $product[0]->tanggal_kadaluarsa
        ];

        session()->put('cart', $cart);

        $htmlCart = view('fol-layout.main')->render();

        return response()->json(['data' => $htmlCart]);

        return redirect('/pos');
        
        }
}