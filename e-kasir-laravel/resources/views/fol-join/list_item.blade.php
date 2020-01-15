@extends('fol-layout/main')

@section('title', 'List Barang')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <h1>Iki halaman List Barang</h1>
@endsection