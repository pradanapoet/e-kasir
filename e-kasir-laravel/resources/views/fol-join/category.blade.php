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

                @if (Session::get('success_update'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Yuhuu!</strong> Kategori Terpilih Berhasil Update.
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
                        <td class="align-middle kategori" id="nama">{{ $kat->nama_kategori }}</td>
                        <td>
                        <button type="button" class="badge badge-info" id="edit-item" data-item-id="{{$kat->id_kategori}}" data-item-nama="{{$kat->nama_kategori}}">edit</button>
                        <form action="/kategori_pemilik/hapus" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" value="{{$kat->id_kategori}}" class="form-control" name="id">
                            <button type="submit" class="badge badge-danger">Hapus</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah kategori -->
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
                        <form action="/kategori_pemilik/update" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="modal-input-id" class="form-control">
                                <input type="text" name="nama_kategori" id="modal-input-name" class="form-control" placeholder="Nama Kategori">
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
    var id = el.data('item-id');
    var name = el.data('item-nama');

    // fill the data in the input fields
    $("#modal-input-id").val(id);
    $("#modal-input-name").val(name);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})
</script>
@endsection
