<?php
namespace App\Http\Controllers;

use View;

//You can create a BaseController:

use App\BarangModel;
class BaseController extends Controller {

    protected $jml_mail;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->jml_mail = BarangModel::count();
        View::share('site_settings', $this->jml_mail);
    }

}

}