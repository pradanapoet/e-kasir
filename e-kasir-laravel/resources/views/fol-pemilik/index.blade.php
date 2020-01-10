@extends('fol-layout/main')

@section('title', 'Pemilik')

@section('user')
    {{ auth()->user()->name }}
@endsection