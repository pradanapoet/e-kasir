@extends('fol-layout/main')

@section('title', 'Barang')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')
<div class="container">
    @if(auth()->user()->role=='pemilik')
                    <button type="button" class="btn btn-primary mb-3 shadow" data-toggle="modal" data-target=".modal-tambah-barang">Tambah Barang</button>
    <div class="card shadow">
        <div class="container mb-4 mt-4">
            <div class="row">
                <div class="col-12">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Whoops!</strong> Barang Tidak Berhasil Ditambahkan.<br><br>
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
                                <strong>Yuhuu!</strong> Barang Baru Berhasil Ditambahkan.
                            </div>
                        @endif

                        @if (Session::get('success_update'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Yuhuu!</strong> Barang Terpilih Berhasil Update.
                            </div>
                        @endif

                        @if (Session::get('fail'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Yuhuu!</strong> Barang Terpilih Telah Dihapus.
                            </div>
                        @endif
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangjoin as $brg)
                            <tr>
                                <th scope="col">{{ $loop->iteration }}</th>
                                <td class="align-middle kategori" id="nama_barang">{{ $brg->nama_barang }}</td>
                                <td class="align-middle kategori" id="nama_kategori">{{$brg->nama_kategori}}</td>
                                <td class="align-middle kategori" id="keterangan">{{ $brg->keterangan }}</td>
                                <td>
                                <button type="button" class="badge badge-info" id="edit-item" data-item-id_barang="{{$brg->id_barang}}" data-item-nama_barang="{{$brg->nama_barang}}" data-item-id_kategori="{{$brg->id_kategori}}" data-item-keterangan="{{$brg->keterangan}}">edit</button>
                                <form action="/listbarang_pemilik/hapus" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" value="{{$brg->id_barang}}" class="form-control" name="id">
                                    <button type="submit" class="badge badge-danger">Hapus</button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tambah list -->
                <div class="modal fade modal-tambah-barang" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open"> </i><b>Tambah Kategori</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/tambah_barang" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control" placeholder=". . .">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Kategori Barang</label>
                                        <select class="form-control" id="id_kategori" name="id_kategori">
                                            <option value="">== Pilih Kategori ==</option>
                                            @foreach ($kategori as $kat)
                                            <option value="{{$kat->id_kategori}}">{{$kat->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control" placeholder=". . .">
                                    </div>
                                    <!-- Perlu Edit Posisi Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger btn-sm" id="tambah-item" value="Reset">Reset</button>
                                        <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Tambah Buku -->

                <!-- Attachment Modal -->

                <div class="modal fade" id="edit-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open"> </i><b>Edit Kategori</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/listbarang_pemilik/update" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id_barang" id="modal-input-id_barang" class="form-control">
                                        <label for="exampleFormControlSelect1">Nama Barang</label>
                                        <input type="text" name="nama_barang" id="modal-input-nama_barang" class="form-control" placeholder="Nama Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Kategori Barang</label>
                                        <select class="form-control" id="modal-input-id_kategori" name="id_kategori">
                                            <option value="">== Pilih Kategori ==</option>
                                            @foreach ($kategori as $kat)
                                            <option value="{{$kat->id_kategori}}">{{$kat->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Keterangan</label>
                                        <input type="text" name="keterangan" id="modal-input-keterangan" class="form-control" placeholder="Keterangan">
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
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
  /**
   * for showing edit item popup
   */

  $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); //ketika klik

    var options = {
      'backdrop': 'static'
    };
    $('#edit-modal').modal(options)
  })

  // on modal show
  $('#edit-modal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); // ngambil data pas di klik

    // get the data
    var id_barang = el.data('item-id_barang');
    var nama_barang = el.data('item-nama_barang');
    var id_kategori = el.data('item-id_kategori');
    var keterangan = el.data('item-keterangan');

    // fill the data in the input fields
    $("#modal-input-id_barang").val(id_barang);
    $("#modal-input-nama_barang").val(nama_barang);
    $("#modal-input-id_kategori").val(id_kategori);
    $("#modal-input-keterangan").val(keterangan);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})
</script>
@endsection
