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
    <br>
    <div class="card">
        <div class="container">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th style="width: 380px;" class="text-center">Nama Barang</th>
                        <th style="width: 40px;" class="text-center">Harga</th>
                        <th style="width: 40px;" class="text-center">Stok</th>
                        <th style="width: 60px;" class="text-center">Kuantitas</th>
                        <th style="width: 30px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stok as $stok)
                    <tr>
                        <th style="width: 10px;"> {{ $loop->iteration }} </th>
                        <td style="width: 380px;" class="kategori" id="nama_barang">{{ $stok->nama_barang }}</td>
                        <td style="width: 40px;" class="text-center" id="harga_jual">Rp.{{ $stok->harga_jual }},-</td>
                        <td style="width: 40px;" class="text-center stok" id="stok">{{ $stok->sisa_stok }}</td>
                        <td style="width: 60px;" class="text-center" id="kuantitas">
                            <input type="number" min="1" onkeypress="return validate(event)" class="form-control">
                        </td>
                        <td style="width: 30px;" class="text-center">
                            <a href="javascript:void(0);" data-item-id_stok="{{ $stok->id_stok }}" class="btn btn-success btn-sm text-center add-to-cart" role="button"><i style="size:2x;" class="fas fa-plus icon-size"></i></a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading fa-spinner text-center" style="font-size:20px; display: none"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="row" id="header-bar">
            @include('fol-join._tabelpos')
        </div>
    </div>
</div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            ele.siblings('.btn-loading').show();
            //console.log("asu");

            $.ajax({
                url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-item-id_stok"),
                method: "GET",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {
                    ele.siblings('.btn-loading').hide();
                    //$("span#status").html('<div class="alert alert-success">'+'Produk Berhasil Ditambahkan'+'</div>');
                    $("#header-bar").html(response.data);
                    //location.reload();
                    console.log(response.data);

                },
                statusCode:{
                    500:function(e){
                        console.log(e.responseText);
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">

        $(".update-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var quantity = parent_row.find(".quantity").val();

            var product_subtotal = parent_row.find("span.product-subtotal");

            var cart_total = $(".cart-total");

            var loading = parent_row.find(".btn-loading");

            loading.show();

            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity},
                dataType: "json",
                success: function (response) {

                    loading.hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                    $("#header-bar").html(response.data);

                    product_subtotal.text(response.subTotal);

                    cart_total.text(response.total);
                }
            });
        });

        // $(".remove-from-cart").click(function (e) {
        //     e.preventDefault();

        //     var ele = $(this);

        //    // var parent_row = ele.parents("tr");

        //     var cart_total = $(".cart-total");


        //         $.ajax({
        //             url: '{{ url('remove-from-cart') }}',
        //             method: "DELETE",
        //             data: {_token: '{{ csrf_token() }}', id: ele.attr("data-item-remove-id_stok")},
        //             dataType: "json",
        //             success: function (response) {
        //                 location.reload();
        //                 // parent_row.remove();
        //                 $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
        //                 $("#header-bar").html(response.data);
        //                 cart_total.text(response.total);
        //             }
        //         });
        // });
    </script>

@stop
