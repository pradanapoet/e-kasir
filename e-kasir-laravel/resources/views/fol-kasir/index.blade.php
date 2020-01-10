@extends('fol-layout/main')

@section('title', 'Kasir')

@section('user')
    {{ auth()->user()->name }}
@endsection