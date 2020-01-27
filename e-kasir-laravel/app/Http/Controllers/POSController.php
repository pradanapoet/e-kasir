<?php

namespace App\Http\Controllers;

use Session;
use App\POSModel;
use App\BarangModel;
use App\StokModel;
use App\TransaksiModel;
use App\DetailTransaksiModel;
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
        $data = request()->except(['_token']);
        $lastid=TransaksiModel::create($data)->id_transaksi;
        if(count($request->nama) > 0)
        {
        foreach($request->nama as $item=>$v){
            $stok = StokModel::where('id_stok', $request->nama[$item])->get();
            $sisa = $stok[0]->sisa_stok - $request->jumlah[$item];
            $update = StokModel::find($request->nama[$item]);
            $update->update(['sisa_stok' => $sisa]);
            $update->save();
            $data2=array(
                'id_transaksi'=>$lastid,
                'id_stok'=>$request->nama[$item],
                'harga'=>$request->harga[$item],
                'jumlah'=>$request->jumlah[$item],
                'subtotal'=>$request->subtotal[$item]
            );
        DetailTransaksiModel::insert($data2);
      }
        }
        $request->session()->forget('cart');
        return redirect('/pos')->with('success_transaksi', ' ');
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
                    "id_stok" => $product[0]->id_stok,
                    "nama" => $product[0]->nama_barang,
                    "kuantitas" => 1,
                    "harga" => $product[0]->harga_jual,
                    "kadaluarsa" => $product[0]->tanggal_kadaluarsa

                ]
            ];

            session()->put('cart', $cart);

            $htmlCart = view('fol-layout.main')->render();

            return response()->json(['data' => $htmlCart]);
            // return redirect('/pos');
            //return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['kuantitas']++;

            session()->put('cart', $cart);

            $htmlCart = view('fol-layout.main')->render();

            return response()->json(['data' => $htmlCart]);
            // return redirect('/pos');
            //return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id_stok" => $product[0]->id_stok,
            "nama" => $product[0]->nama_barang,
            "kuantitas" => 1,
            "harga" => $product[0]->harga_jual,
            "kadaluarsa" => $product[0]->tanggal_kadaluarsa
        ];

        session()->put('cart', $cart);

        $htmlCart = view('fol-layout.main')->render();

        return response()->json(['data' => $htmlCart]);

        // return redirect('/pos');

    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            $total = $this->getCartTotal();

            $htmlCart = view('fol-layout.main')->render();

            return response()->json(['msg' => 'Product removed successfully', 'data' => $htmlCart, 'total' => $total]);

            return redirect('/pos');
            //session()->flash('success', 'Product removed successfully');
        }
    }


    /**
     * getCartTotal
     *
     *
     * @return float|int
     */
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('cart');

        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }

}