@extends('fol-layout/main')

@section('title', 'Kategori')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')
<h1>Iki halaman kategori</h1>
<div class="container">
    @if(auth()->user()->role=='pemilik')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal-tambah-kategori">Tambah Kategori</button>
    @endif
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $kat)

            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                <td>{{ $kat->nama_kategori }}</td>
                <td>
                    <a href="" class="badge badge-success">edit</a>
                    <a href="" class="badge badge-danger">delete</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade modal-tambah-kategori" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open"> </i><b>Tambah Kategori</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambah_kategori" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label><i class="fas fa-book text-dark"></i>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" autocomplete="off">
                        {{-- ?php echo form_error('judul_buku'); ?> --}}
                    </div>
                    <!-- Perlu Edit Posisi Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Buku -->
@endsection
