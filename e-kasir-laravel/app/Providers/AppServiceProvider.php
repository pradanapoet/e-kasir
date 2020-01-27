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
                ->count();
        View::share('notif', $notif);

        // $data = BarangModel::All();
        // View::share('isi',$data);

        $data = DB::table('stok')
                ->select('*')
                ->where('tanggal_kadaluarsa',"<",Carbon::tomorrow())
                ->get();
        View::share('isi',$data);
        Schema::defaultStringLength(191);
    }
}
