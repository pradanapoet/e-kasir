@extends('fol-layout/main')

@section('title', 'Laporan Penjualan')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <h1>Iki halaman laporan penjualan</h1>
@endsection