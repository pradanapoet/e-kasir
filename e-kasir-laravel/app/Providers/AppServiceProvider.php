<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\StokModel;
use DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $notif = DB::table('stok')
                ->select('*')
                ->where('tanggal_kadaluarsa',"<",Carbon::tomorrow())
                ->where('status','!=','expired')
                ->count();
        View::share('notif', $notif);

        // $data = BarangModel::All();
        // View::share('isi',$data);

        $data = DB::table('stok')
                ->select('*')
                ->join('barang','stok.id_barang','=','barang.id_barang')
                ->where('tanggal_kadaluarsa',"<",Carbon::tomorrow())
                ->where('status','!=','expired')
                ->get();
        View::share('isi',$data);
        Schema::defaultStringLength(191);
    }
}
