@extends('fol-layout/main')

@section('title', 'List Stock Barang')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')

{{-- Script untuk input type number --}}
<script>
    function validate(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>


<div class="container">
    <div class="row">
        <div class="col-12">
            @if(auth()->user()->role=='pemilik')
            <button type="button" class="btn btn-primary mb-3 shadow" data-toggle="modal"
                data-target=".modal-tambah-barang"><i class="fas fa-plus"></i> Tambah Stok Barang</button>
            @if (count($errors) > 0)
            <div class="alert alert-danger ">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Whoops!</strong> Stok Barang Tidak Berhasil Ditambahkan.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (Session::get('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Yuhuu!</strong> Stok Barang Baru Berhasil Ditambahkan.
            </div>
            @endif

            @if (Session::get('success_update'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Yuhuu!</strong> Stok Barang Terpilih Berhasil Update.
            </div>
            @endif

            @if (Session::get('fail'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Yuhuu!</strong> Stok Barang Terpilih Telah Dihapus.
            </div>
            @endif
            @endif
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Nama Barang</th>
                                    <th class="text-center" scope="col">Tanggal Masuk</th>
                                    <th class="text-center" scope="col">Tanggal Kadaluarsa</th>
                                    <th class="text-center" scope="col">Jumlah Barang Masuk</th>
                                    <th class="text-center" scope="col">Barcode</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=0;
                                    $bar = array(); ?>
                                @foreach ($stok as $stok)
                                <?php
                            $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
                            $barcode = $generator->getBarcode($stok->id_stok, $generator::TYPE_CODE_128);
                            ?>
                            
                                <tr>
                                    <th class="align-middle text-center" scope="col">{{ $loop->iteration }}</th>
                                    <td class="align-middle kategori text-left" id="nama_barang">
                                        {{ $stok->nama_barang }}</td>
                                    <td class="align-middle kategori text-center" id="tanggal_masuk">
                                        {{ $stok->tanggal_masuk }}</td>
                                    <td class="align-middle kategori text-center" id="tanggal_kadaluarsa">
                                        {{ $stok->tanggal_kadaluarsa }}</td>
                                    <td class="align-middle text-center">{{ $stok->jumlah_stok_masuk }}</td>
                                    <td class="align-middle text-center">
                                        <div class="text-center">
                                        <p> <?php echo $barcode ?> </p>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="badge badge-secondary" id="detail-item"
                                            data-item-id_stok="{{$stok->id_stok}}"
                                            data-item-id_barang="{{$stok->id_barang}}"
                                            data-item-stok_masuk="{{$stok->jumlah_stok_masuk}}"
                                            data-item-tanggal_masuk="{{$stok->tanggal_masuk}}"
                                            data-item-tanggal_kadaluarsa="{{$stok->tanggal_kadaluarsa}}"
                                            data-item-sisa_stok="{{$stok->sisa_stok}}"
                                            data-item-harga_beli="{{$stok->harga_beli}}"
                                            data-item-harga_jual="{{$stok->harga_jual}}"
                                            data-item-barcode="{{ $barcode }}">Detail</button>
                                        @if (auth()->user()->role=='pemilik')
                                        <button type="button" class="badge badge-info" id="edit-item"
                                            data-item-id_stok="{{$stok->id_stok}}"
                                            data-item-id_barang="{{$stok->id_barang}}"
                                            data-item-stok_masuk="{{$stok->jumlah_stok_masuk}}"
                                            data-item-tanggal_masuk="{{$stok->tanggal_masuk}}"
                                            data-item-tanggal_kadaluarsa="{{$stok->tanggal_kadaluarsa}}"
                                            data-item-sisa_stok="{{$stok->sisa_stok}}"
                                            data-item-harga_beli="{{$stok->harga_beli}}"
                                            data-item-harga_jual="{{$stok->harga_jual}}">Edit</button>

                                        <button type="button" class="badge badge-success" id="cetak-item"
                                            data-item-id_stok="{{$stok->id_stok}}"
                                            data-item-nama_barang="{{$stok->nama_barang}}">Cetak</button>
                                        <form action="/liststok_pemilik/hapus" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" value="{{$stok->id_stok}}" class="form-control"
                                                name="id">
                                            <button type="submit" class="badge badge-danger">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                <?php
                                $bar[$i] = $stok->id_stok;
                                $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Stok -->
    <div class="modal fade modal-tambah-barang" id="modal-tambah" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><b>Tambah Stok</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambah_stok" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Barang</label>
                            <select class="form-control" id="id_barang" name="id_barang">
                                <option value="">Pilih Barang</option>
                                @foreach ($barang as $brg)
                                <option value="{{$brg->id_barang}}">{{$brg->nama_barang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-date-input">Tanggal Masuk</label>
                                    <input class="form-control" type="date" id="tanggal_masuk" name="tanggal_masuk">
                                </div>
                                <div class="form-group">
                                    <label for="example-date-input">Tanggal Kadaluarsa</label>
                                    <input class="form-control" type="date" id="tanggal_kadaluarsa"
                                        name="tanggal_kadaluarsa">
                                </div>
                                <div class="form-group">
                                    <label for="example-date-input">Jumah Stok</label>
                                    <input type="text" onkeypress="return validate(event)" name="jumlah_stok_masuk"
                                        class="form-control" placeholder="Jumlah Stok">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-date-input">Harga Beli</label>
                                    <input type="text" onkeypress="return validate(event)" name="harga_beli"
                                        class="form-control" placeholder="Harga Beli">
                                </div>
                                <div class="form-group">
                                    <label for="example-date-input">Harga Jual</label>
                                    <input type="text" onkeypress="return validate(event)" name="harga_jual"
                                        class="form-control" placeholder="Harga Jual">
                                </div>
                            </div>
                        </div>
                        <!-- Perlu Edit Posisi Modal Footer -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger btn-sm" id="tambah-item"
                                value="Reset">Reset</button>
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Stok -->

    <!-- Modal Edit Stok-->
    <div class="modal fade" id="edit-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open">
                        </i><b>Edit Stok</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/liststok_pemilik/update" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id_stok" id="modal-input-id_stok" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Barang</label>
                            <select class="form-control" id="modal-input-id_barang" name="id_barang">
                                @foreach ($barang as $brg)
                                <option value="{{$brg->id_barang}}">{{$brg->nama_barang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-date-input">Tanggal Masuk</label>
                                    <input class="form-control" type="date" id="modal-input-tanggal_masuk"
                                        name="tanggal_masuk">
                                </div>
                                <div class="form-group">
                                    <label for="example-date-input">Tanggal Kadaluarsa</label>
                                    <input class="form-control" type="date" id="modal-input-tanggal_kadaluarsa"
                                        name="tanggal_kadaluarsa">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Jumlah Stok Masuk</label>
                                    <input type="text" onkeypress="return validate(event)" id="modal-input-jumlah_stok"
                                        name="jumlah_stok_masuk" class="form-control" placeholder="Jumlah Stok">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Sisa Stok</label>
                                    <input type="text" onkeypress="return validate(event)" id="modal-input-sisa_stok"
                                        name="sisa_stok" class="form-control" placeholder="Sisa Stok">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Harga Beli</label>
                                    <input type="text" onkeypress="return validate(event)" id="modal-input-harga_beli"
                                        name="harga_beli" class="form-control" placeholder="Harga Beli">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Harga Jual</label>
                                    <input type="text" onkeypress="return validate(event)" id="modal-input-harga_jual"
                                        name="harga_jual" class="form-control" placeholder="Harga Jual">
                                </div>
                            </div>
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
    <!-- Modal Edit Stok -->

    <!-- Cetak Barcode Modal -->
    <div class="modal fade" id="cetak-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open">
                        </i><b>Cetak Barcode</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- <form action="/print-barcode" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" value="{{$stok->id_stok}}" class="form-control"
                    name="id">
                    <input type="hidden" value="{{$stok->nama_barang}}" class="form-control" name="nama">
                    <button type="submit" class="badge badge-info">Cetak</button>
                    </form> --}}


                    <form action="/print-barcode" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="modal-input-id" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="nama" id="modal-input-nama_barang" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Cetak sebanyak ?</label>
                            <select class="form-control" name="jumlah">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="135">135</option>
                            </select>
                        </div>
                        <!-- Perlu Edit Posisi Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            <input type="submit" value="Cetak" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detail-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open">
                        </i><b>Detail Stok</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleFormControlSelect1">Id Stok :</label>
                            <input type="text" id="modal-show-id_stok" name="id_barang" class="form-control" readonly>
                            <label for="exampleFormControlSelect1">Id Barang :</label>
                            <input type="text" id="modal-show-id_barang" name="id_barang" class="form-control" readonly>
                            <label for="exampleFormControlSelect1">Tanggal Masuk :</label>
                            <input type="text" id="modal-show-tanggal_masuk" name="tanggal_masuk" class="form-control"
                                readonly>
                            <label for="exampleFormControlSelect1">Tanggal Kadaluarsa :</label>
                            <input type="text" id="modal-show-tanggal_kadaluarsa" name="tanggal_kadaluarsa"
                                class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlSelect1">Jumlah Stok :</label>
                            <input type="text" id="modal-show-jumlah_stok" name="jumlah_stok" class="form-control"
                                readonly>
                            <label for="exampleFormControlSelect1">Sisa Stok :</label>
                            <input type="text" id="modal-show-sisa_stok" name="sisa_stok" class="form-control" readonly>
                            <label for="exampleFormControlSelect1">Harga Beli :</label>
                            <input type="text" id="modal-show-harga_beli" name="hara_beli" class="form-control"
                                readonly>
                            <label for="exampleFormControlSelect1">Harga Jual :</label>
                            <input type="text" id="modal-show-harga_jual" name="harga_jual" class="form-control"
                                readonly>
                            <label for="exampleFormControlSelect1">Barcode :</label>
                            <div id="modal-show-barcode"></div>
                        </div>
                    </div>
                    <!-- Perlu Edit Posisi Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail Modal -->
</div>

<script>
    $(document).ready(function() {
  /**
   * for showing edit item popup
   */

  $(document).on('click', "#detail-item", function() {
    $(this).addClass('detail-item-trigger-clicked'); //ketika klik

    var options = {
      'backdrop': 'static'
    };
    $('#detail-modal').modal(options)
  })

  // on modal show
  $('#detail-modal').on('show.bs.modal', function() {
    var el = $(".detail-item-trigger-clicked"); // ngambil data pas di klik

    // get the data
    var id_stok = el.data('item-id_stok');
    var id_barang = el.data('item-id_barang');
    var jumlah_stok_masuk = el.data('item-stok_masuk');
    var tanggal_masuk = el.data('item-tanggal_masuk');
    var tanggal_kadaluarsa = el.data('item-tanggal_kadaluarsa');
    var sisa_stok = el.data('item-sisa_stok');
    var harga_beli = el.data('item-harga_beli');
    var harga_jual = el.data('item-harga_jual');
    var barcode = el.data('item-barcode');




    $("#modal-show-id_stok").val(id_stok);
    $("#modal-show-id_barang").val(id_barang);
    $("#modal-show-jumlah_stok").val(jumlah_stok_masuk);
    $("#modal-show-tanggal_masuk").val(tanggal_masuk);
    $("#modal-show-tanggal_kadaluarsa").val(tanggal_kadaluarsa);
    $("#modal-show-sisa_stok").val(sisa_stok);
    $("#modal-show-harga_beli").val(harga_beli);
    $("#modal-show-harga_jual").val(harga_jual);
    $("#modal-show-barcode").html(barcode);


  })

  // on modal hide
  $('#detail-modal').on('hide.bs.modal', function() {
    $('.detail-item-trigger-clicked').removeClass('detail-item-trigger-clicked')
    $("#detail-modal").trigger("reset");
  });



})
</script>

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
    var id_stok = el.data('item-id_stok');
    var id_barang = el.data('item-id_barang');
    var jumlah_stok_masuk = el.data('item-stok_masuk');
    var tanggal_masuk = el.data('item-tanggal_masuk');
    var tanggal_kadaluarsa = el.data('item-tanggal_kadaluarsa');
    var sisa_stok = el.data('item-sisa_stok');
    var harga_beli = el.data('item-harga_beli');
    var harga_jual = el.data('item-harga_jual');


    // fill the data in the input fields
    $("#modal-input-id_stok").val(id_stok);
    $("#modal-input-id_barang").val(id_barang);
    $("#modal-input-jumlah_stok").val(jumlah_stok_masuk);
    $("#modal-input-tanggal_masuk").val(tanggal_masuk);
    $("#modal-input-tanggal_kadaluarsa").val(tanggal_kadaluarsa);
    $("#modal-input-sisa_stok").val(sisa_stok);
    $("#modal-input-harga_beli").val(harga_beli);
    $("#modal-input-harga_jual").val(harga_jual);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  });



})
</script>

<script>
    $(document).ready(function() {
    /**
   * for showing edit item popup
   */



  $(document).on('click', "#cetak-item", function() {
    $(this).addClass('cetak-item-trigger-clicked'); //ketika klik

    var options = {
      'backdrop': 'static'
    };
    $('#cetak-modal').modal(options)
  })

  // on modal show
  $('#cetak-modal').on('show.bs.modal', function() {
    var el = $(".cetak-item-trigger-clicked"); // ngambil data pas di klik

    // get the data
    var id = el.data('item-id_stok');
    var nama_barang = el.data('item-nama_barang');

    // fill the data in the input fields
    $("#modal-input-id").val(id);
    $("#modal-input-nama_barang").val(nama_barang);
  })

  // on modal hide
  $('#cetak-modal').on('hide.bs.modal', function() {
    $('.cetak-item-trigger-clicked').removeClass('cetak-item-trigger-clicked')
    $("#cetak-modal").trigger("reset");
  });
})
</script>
@endsection