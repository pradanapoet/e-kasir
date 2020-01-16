@extends('fol-layout/main')

@section('title', 'Kategori')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')
<h1>Iki halaman kategori {{dump($kat)}}</h1>
<div class="container">
    <form action="/tambah_kategori" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan Nama Kategori" value="{{ $kat->nama_kategori }}">
        </div>
        <!-- Perlu Edit Posisi Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
        </div>
    </form>
</div>
@endsection
