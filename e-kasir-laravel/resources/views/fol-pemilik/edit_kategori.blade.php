@extends('fol-layout/main')

@section('title', 'Kategori')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')
<h1>Iki halaman kategori</h1>

@endsection
