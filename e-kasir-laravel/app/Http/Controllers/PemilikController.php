<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\StokModel;
use Carbon\Carbon;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $jml_mail = DB::table('barang')
                        ->select('*')
                        ->count();
        $stok = DB::table('stok')
                        ->select('*')
                        ->get();
                        foreach ($stok as $s) {
                            $masuk += $s->jumlah_stok_masuk;
                            $sisa += $s->sisa_stok;
                            $total_pengeluaran += $s->jumlah_stok_masuk * $s->harga_beli;
                        }
        $hasil = $masuk - $sisa;
        $transaksi = DB::table('transaksi')
                    ->select('total')->get();
                    foreach ($transaksi as $t) {
                        $total_pemasukan += $t->total;
                    }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan = number_format($total,2,",",".");
        return view('fol-pemilik.index',compact('jml_mail','hasil','keuntungan'));
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
       //

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

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request)
    // {
    //     $id = $request->input('id');
    //     CategoryModel::destroy($id);
    //     return redirect('/kategori_pemilik')->with('fail', ' ');
    // }

    // public function kategori()
    // {
    //     $kategori = CategoryModel::all();
    //     return view('fol-join.category',compact('kategori'));
    // }
    // public function listbarang()
    // {
    //     return view('fol-join.list_item');
    // }
    // public function liststok()
    // {
    //     return view('fol-join.list_stock_item');
    // }
    public function laporan_penjualan()
    {
        $transaksi = DB::table('transaksi')->get();
        return view('fol-join.selling_report',compact('transaksi'));
    }

    public function detail_laporan_penjualan(Request $request)
    {
        $total = $request->total;
        $detail_transaksi = DB::table('detail_transaksi')
        ->join('transaksi','transaksi.id_transaksi','=','detail_transaksi.id_transaksi')
        ->join('stok','stok.id_stok','=','detail_transaksi.id_stok')
        ->join('barang','stok.id_barang','=','barang.id_barang')
        ->where('detail_transaksi.id_transaksi', $request->id )->get();
        // dd($detail_transaksi);
        return view('fol-join.selling_report_detail',compact('detail_transaksi','total'));
    }

    public function laporan_laba()
    {
        $dari = NULL;
        $sampai = NULL;
        $transaksi = DB::table('transaksi')->get();
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->get();
        return view('fol-join.profit_report',compact('transaksi','stok','dari','sampai'));
    }
    public function laporan_laba_sort(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $transaksi = DB::table('transaksi')
        ->whereBetween('created_at',array($dari,$sampai))->get();
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')
        ->whereBetween('stok.tanggal_masuk',array($dari,$sampai))->get();
        return view('fol-join.profit_report',compact('transaksi','stok','dari','sampai'));

    }
    public function laporan_barang()
    {
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->get();
        return view('fol-join.item_report', compact('stok'));
    }
    public function update_status($id)
    {
        $update = StokModel::find($id);
        //dd($update);
        $update->update(['status' => 'expired']);
        $update->save();

        // $htmlCart = view('fol-join._tabelnotif')->render();

        // return response()->json(['data' => $htmlCart]);
            // return redirect('/pos');
            return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function kadaluarsa()
    {
        $stok = DB::table('stok')
                ->select('*')
                ->join('barang','barang.id_barang','=','stok.id_barang')
                ->where('tanggal_kadaluarsa',"<",Carbon::tomorrow())
                ->where('status','!=','expired')
                ->get();
        return view('fol-join.kadaluarsa', compact('stok'));
    }
}