@extends('fol-layout/main')

@section('title', 'Laporan Barang')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <div class="container">
        <h3>Laporan Barang</h3>
        <div class="card shadow">
            <a class="btn btn-info shadow" style="width:50px; margin-top:20px; margin-left:25px;" href="/lap_barang_pemilik_print"><i class="fas fa-print"></i></a>
            <div class="container mt-4 mb-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Tanggal Kadaluarsa</th>
                            <th scope="col">Barang Masuk</th>
                            <th scope="col">Barang Terjual</th>
                            <th scope="col">Sisa Barang</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stok as $stok)
                        <tr>
                            <th scope="col">{{ $loop->iteration }}</th>
                            <td class="align-middle kategori" id="nama_barang">{{ $stok->nama_barang }}</td>
                            <td class="align-middle kategori" id="tanggal_masuk">{{ $stok->tanggal_masuk }}</td>
                            <td class="align-middle kategori" id="tanggal_kadaluarsa">{{ $stok->tanggal_kadaluarsa }}</td>
                            <td>{{ $stok->jumlah_stok_masuk }}</td>
                            <td>{{$stok->jumlah_stok_masuk - $stok->sisa_stok }}</td>
                            <td>{{ $stok->sisa_stok }}</td>
                            <td>{{ $stok->status }}</td>
                            <td>
                            <button type="button" class="badge badge-secondary" id="detail-item" data-item-id_stok="{{$stok->id_stok}}" data-item-id_barang="{{$stok->id_barang}}" data-item-stok_masuk="{{$stok->jumlah_stok_masuk}}" data-item-tanggal_masuk="{{$stok->tanggal_masuk}}" data-item-tanggal_kadaluarsa="{{$stok->tanggal_kadaluarsa}}" data-item-sisa_stok="{{$stok->sisa_stok}}" data-item-harga_beli="{{$stok->harga_beli}}" data-item-harga_jual="{{$stok->harga_jual}}">Detail</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->

    <div class="modal fade" id="detail-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;"><i class="fas fa-book-open"> </i><b>Detail Stok</b></h5>
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
                            <input type="text" id="modal-show-tanggal_masuk" name="tanggal_masuk" class="form-control" readonly>
                            <label for="exampleFormControlSelect1">Tanggal Kadaluarsa :</label>
                            <input type="text" id="modal-show-tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlSelect1">Jumlah Stok :</label>
                            <input type="text" id="modal-show-jumlah_stok" name="jumlah_stok" class="form-control" readonly>
                            <label for="exampleFormControlSelect1">Sisa Stok :</label>
                            <input type="text" id="modal-show-sisa_stok" name="sisa_stok" class="form-control" readonly>
                            <label for="exampleFormControlSelect1">Harga Beli :</label>
                            <input type="text" id="modal-show-harga_beli" name="hara_beli" class="form-control" readonly>
                            <label for="exampleFormControlSelect1">Harga Jual :</label>
                            <input type="text" id="modal-show-harga_jual" name="harga_jual" class="form-control" readonly>
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


    // fill the data in the input fields
    $("#modal-show-id_stok").val(id_stok);
    $("#modal-show-id_barang").val(id_barang);
    $("#modal-show-jumlah_stok").val(jumlah_stok_masuk);
    $("#modal-show-tanggal_masuk").val(tanggal_masuk);
    $("#modal-show-tanggal_kadaluarsa").val(tanggal_kadaluarsa);
    $("#modal-show-sisa_stok").val(sisa_stok);
    $("#modal-show-harga_beli").val(harga_beli);
    $("#modal-show-harga_jual").val(harga_jual);
    })

  // on modal hide
    $('#edit-modal').on('hide.bs.modal', function() {
    $('.detail-item-trigger-clicked').removeClass('detail-item-trigger-clicked')
    $("#edit-modal").trigger("reset");
    });



})
</script>
@endsection