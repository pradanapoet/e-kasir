@extends('fol-layout/main')

@section('title', 'Laporan Keuntungan')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <h1>Iki halaman laporan keuntungan</h1>
@endsection