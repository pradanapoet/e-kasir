<?php

namespace App\Http\Controllers;

use Auth;
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
                return redirect('/kasir');
            }
            
        }

        return redirect('/login')->with('alert', 'Username atau Password Salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    // public function cek(Request $request){
    //     // dd($request->all());
    //     if(Auth::attempt($request->only('username','password'))){
    //         dd($request);
    //         // if(auth()->user()->role == 'pemilik'){
    //         //     return redirect('/pemilik/dashboard');
    //         // }else if(auth()->user()->role == 'pemilik'){
    //         //     return redirect('/kasir/dashboard');
    //         // }
    //     }
    //     dd($request);
    //     // return redirect('/')->with('alert', 'Username atau Password Salah!');
    // }

    // public function logout(){
    //     Auth::logout();
    //     return redirect('/');
    // }

}
