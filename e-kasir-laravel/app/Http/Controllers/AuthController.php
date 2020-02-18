<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(){
        return view('welcome');
    }

    public function postlogin(Request $request){
        // dd($request->all());
        if(Auth::attempt($request->only('username','password'))){

            if( $request->user()->role == 'pemilik' ){
                return redirect('/pemilik');
            }else{
                return redirect('/pos');
            }

        }

        return redirect('/')->with('alert', 'Username atau Password Salah!');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
