@extends('fol-layout/main')

@section('title', 'POS')

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

@if (Session::get('success_transaksi'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Yuhuu!</strong> Transaksi Berhasil Ditambahkan.
</div>
@endif
<span id="status"></span>
<div class="container">
    <div class="card shadow">
        <div class="container mt-4 mb-4">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th style="width: 10px;">Code</th>
                        <th style="width: 380px;" class="text-center">Nama Barang</th>
                        <th style="width: 40px;" class="text-center">Harga</th>
                        <th style="width: 40px;" class="text-center">Stok</th>
                        <th style="width: 30px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stok as $stok)
                    <tr>
                        <th style="width: 10px;"> {{ $loop->iteration }} </th>
                        <th style="width: 10px;"> {{ $stok->id_stok }} </th>
                        <td style="width: 380px;" class="kategori" id="nama_barang">{{ $stok->nama_barang }}</td>
                        <td style="width: 40px;" class="text-center" id="harga_jual">Rp.{{ $stok->harga_jual }},-</td>
                        <td style="width: 40px;" class="text-center stok" id="stok">{{ $stok->sisa_stok }}</td>
                        @if ($stok->sisa_stok > 0)
                        <td style="width: 30px;" class="text-center">
                            <a href="javascript:void(0);" data-item-id_stok="{{ $stok->id_stok }}"
                                class="btn btn-success btn-sm text-center add-to-cart" role="button"><i style="size:2x;"
                                    class="fas fa-plus icon-size"></i></a>
                            <i class="fa fa-circle-o-notch fa-spin btn-loading fa-spinner text-center"
                                style="font-size:20px; display: none"></i>
                        </td>
                        @else
                        <td class="text-center">Kosong</td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="card shadow">
        <div class="container mt-4 mb-4">
            <div class="row" id="header-bar">
                @include('fol-join._tabelpos')
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(".add-to-cart").click(function (e) {
            e.preventDefault();
            var person = prompt("Jumlah barang", "1");
            console.log(person);
            if (person != null) {
                    var ele = $(this);
                    ele.siblings('.btn-loading').show();
                    $.ajax({
                        url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-item-id_stok") + '/' + person,
                        method: "GET",
                        data: {_token: '{{ csrf_token() }}'},
                        dataType: "json",
                        success: function (response) {
                            ele.siblings('.btn-loading').hide();
                            //$("span#status").html('<div class="alert alert-success">'+'Produk Berhasil Ditambahkan'+'</div>');
                            $("#header-bar").html(response.data);
                            //location.reload();
                            // console.log(response);

                        },
                        statusCode:{
                            500:function(e){
                                console.log(e.responseText);
                            }
                        }
                    });
            }

        });
</script>

<script type="text/javascript">
    //selector .on => event, ketika click elemen apa? si .remove-form-cart

        $("body").on('click', '.remove-from-cart',function (e) {
            e.preventDefault();

            var ele = $(this);
            var cart_total = $(".cart-total");
            var id = ele.attr("data-item-remove-id_stok");
            if(confirm("Are you sure")) {
                $.ajax({
                    // url: '{{ url('remove-from-cart') }}',
                    url: '{{ url('remove-from-cart') }}' + '/' + id,
                    method: "GET",
                    data: {_token: '{{ csrf_token() }}'},
                    dataType: "json",
                    success: function (response) {;
                        ele.parents('tr').remove();
                        // $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                        $("#header-bar").html(response.data);
                        // cart_total.text(response.total);
                    }
                });
            }
        });
</script>

@stop