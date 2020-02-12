<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\StokModel;
use Carbon\Carbon;
use Excel;
use App\Http\Controllers\Controller;
use App\Exports\ExportBarang;
use App\Exports\ExportBarangFromView;


class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = Carbon::now()->format('Y');
        $monthNow = Carbon::now()->format('m');

        $transaksi = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', $monthNow )->whereYear('created_at', '=', $year)->get();
        $transaksi0 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $year)->get();
        $transaksi1 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $year)->get();
        $transaksi2 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $year)->get();
        $transaksi3 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $year)->get();
        $transaksi4 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $year)->get();
        $transaksi5 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $year)->get();
        $transaksi6 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $year)->get();
        $transaksi7 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $year)->get();
        $transaksi8 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $year)->get();
        $transaksi9 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $year)->get();
        $transaksi10 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $year)->get();
        $transaksi11 = DB::table('transaksi')->select('*')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=',
        $year)->get();

        $stok = DB::table('stok')->select('*')->whereMonth('created_at', '=', $monthNow)->whereYear('created_at', '=',
        $year)->get();
        $stok0 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=',
        $year)->get();
        $stok1 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=',
        $year)->get();
        $stok2 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=',
        $year)->get();
        $stok3 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=',
        $year)->get();
        $stok4 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=',
        $year)->get();
        $stok5 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=',
        $year)->get();
        $stok6 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=',
        $year)->get();
        $stok7 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=',
        $year)->get();
        $stok8 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=',
        $year)->get();
        $stok9 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=',
        $year)->get();
        $stok10 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=',
        $year)->get();
        $stok11 = DB::table('stok')->select('*')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=',
        $year)->get();

        $jml_mail = DB::table('barang')->select('*')->count();

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $hasil = null;
        $total = null;
        foreach ($stok as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        $hasil = $masuk - $sisa;
        foreach ($transaksi as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok0 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi0 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan0 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok1 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi1 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan1 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok2 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi2 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan2 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok3 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi3 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan3 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok4 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi4 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan4 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok5 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi5 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan5 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok6 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi6 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan6 = number_format($total,2,",",".");

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok7 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi7 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan7 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok8 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi8 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan8 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok9 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi9 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan9 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok10 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi10 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan10 = $total;

        //Batas
        $total_pemasukan = null;
        $total_pengeluaran = null;
        $masuk = null;
        $sisa = null;
        $total = null;
        foreach ($stok11 as $s0) {
            $masuk += $s0->jumlah_stok_masuk;
            $sisa += $s0->sisa_stok;
            $total_pengeluaran += $s0->jumlah_stok_masuk * $s0->harga_beli;
        }
        foreach ($transaksi11 as $t0) {
            $total_pemasukan += $t0->total;
        }
        $total = $total_pemasukan - $total_pengeluaran;
        $keuntungan11 = $total;
        return view('fol-pemilik.index',compact('jml_mail','hasil','keuntungan','keuntungan0','keuntungan1','keuntungan2','keuntungan3','keuntungan4','keuntungan5','keuntungan6','keuntungan7','keuntungan8','keuntungan9','keuntungan10','keuntungan11'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function laporan_penjualan()
    {
        $transaksi = DB::table('transaksi')->get();
        return view('fol-join.selling_report',compact('transaksi'));
    }

    public function laporan_penjualan_print()
    {
        $carbon = Carbon::now();
        $transaksi = DB::table('transaksi')->get();
        return view('fol-join.selling_report_print',compact('transaksi','carbon'));
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
        $status_sort = "belum";
        $dari = NULL;
        $sampai = NULL;
        $transaksi = DB::table('transaksi')->get();
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->get();
        return view('fol-join.profit_report',compact('transaksi','stok','dari','sampai','status_sort'));
    }

    public function laporan_laba_print()
    {
        $carbon = Carbon::now();
        $dari = NULL;
        $sampai = NULL;
        $transaksi = DB::table('transaksi')->get();
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->get();
        return view('fol-join.profit_report_print',compact('transaksi','stok','dari','sampai','carbon'));
    }

    public function laporan_laba_sort(Request $request)
    {
        $status_sort = "sudah";
        $dari = $request->dari;
        $sampai = $request->sampai;
        $transaksi = DB::table('transaksi')
        ->whereBetween('created_at',array($dari,$sampai))->get();
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')
        ->whereBetween('stok.tanggal_masuk',array($dari,$sampai))->get();
        return view('fol-join.profit_report',compact('transaksi','stok','dari','sampai','status_sort'));
    }

    public function laporan_laba_print_sorted(Request $request)
    {
        $carbon = Carbon::now();
        //dd($request);
        $dari = $request->dari;
        $sampai = $request->sampai;
        $transaksi = DB::table('transaksi')
        ->whereBetween('created_at',array($dari,$sampai))->get();
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')
        ->whereBetween('stok.tanggal_masuk',array($dari,$sampai))->get();
        return view('fol-join.profit_report_print',compact('transaksi','stok','dari','sampai','carbon'));
    }

    public function laporan_barang()
    {
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')->get();
        return view('fol-join.item_report', compact('stok'));
    }

    public function laporan_barang_print()
    {
        $carbon = Carbon::now();
        $stok = DB::table('stok')->join('barang','stok.id_barang','=','barang.id_barang')
        ->orderBy('stok.status')->get();
        return view('fol-join.item_report_print', compact('stok','carbon'));

        // return Excel::download(new ExportBarang, 'barang.xlsx');
        // return Excel::download(new ExportBarangFromView, 'LaporanBarang.xlsx');
    }

    public function update_status($id)
    {
        $update = StokModel::find($id);
        //dd($update);
        $update->update(['status' => 'expired']);
        $update->save();
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