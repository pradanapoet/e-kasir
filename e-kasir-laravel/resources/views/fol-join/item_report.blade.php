@extends('fol-layout/main')

@section('title', 'Laporan Barang')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <h1>Iki halaman laporan barang</h1>
@endsection