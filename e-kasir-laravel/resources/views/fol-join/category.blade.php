@extends('fol-layout/main')

@section('title', 'Kategori')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')
<h1>Iki halaman kategori</h1>
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(auth()->user()->role=='pemilik')
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target=".modal-tambah-kategori">Tambah Kategori</button>
                @if (count($errors) > 0)
                    <div class="alert alert-danger ">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>Whoops!</strong> Kategori Tidak Berhasil Ditambahkan.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ 'Masukkan nama kategori terlebih dahulu sebelum menyimpannya.' }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::get('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>Yuhuu!</strong> Kategori Baru Berhasil Ditambahkan.
                    </div>
                @endif

                @if (Session::get('fail'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>Yuhuu!</strong> Kategori Terpilih Telah Dihapus.
                    </div>
                @endif
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
                        <a href="kategori_pemilik/edit/{{ $kat->id }}" class="badge badge-info my-2 d-inline">Detail</a>
                        <form action="/kategori_pemilik/hapus" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" value="{{$kat->id}}" class="form-control" name="id">
                            <button type="submit" class="badge badge-danger">Hapus</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Buku -->
        <div class="modal fade modal-tambah-kategori" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
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
                                {{-- <label><i class="fas fa-book text-dark"></i>Nama Kategori</label> --}}
                                <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori">
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

        <!-- Modal Edit Buku -->
        <div class="modal fade modal-edit-kategori" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open"> </i><b>Edit Kategori</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/tambah_kategori" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                {{-- <label><i class="fas fa-book text-dark"></i>Nama Kategori</label> --}}
                                {{ dump($kat) }};
                                <input type="text" name="nama_kategori" class="form-control" placeholder="{{ $kat->nama_kategori }}">
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
        <!-- Modal Edit Buku -->
        </div>
    </div>
@endsection
