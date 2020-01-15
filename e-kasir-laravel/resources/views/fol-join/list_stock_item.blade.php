@extends('fol-layout/main')

@section('title', 'List Stok Barang')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <h1>Iki halaman List Stok Barang</h1>
@endsection