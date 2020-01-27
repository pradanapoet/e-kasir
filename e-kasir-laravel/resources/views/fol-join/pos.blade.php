@extends('fol-layout/main')

@section('title', 'POS')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')

@if (Session::get('success_transaksi'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Yuhuu!</strong> Transaksi Berhasil Ditambahkan.
</div>
@endif
<span id="status"></span>
<div class="container">
    <div class="card">
        <div class="container">
            <form action="/pos/store" method="POST">
            @csrf
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width: 10px;">#</th>
                    <th>Product</th>
                    <th style="width: 40px;" class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th style="width: 40px;" class="text-center">Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php $total = 0 ?>

                @if(session('cart'))
                    @foreach((array) session('cart') as $id => $details)

                        <?php $total += $details['harga'] * $details['kuantitas'] ?>

                        <tr>
                            <th style="width: 10px;" scope="col">{{ $loop->iteration }}</th>
                            <td data-th="Product">{{ $details['nama'] }}<input type="hidden" name="nama[]" value="{{ $details['id_stok']}}"></td>
                            <td style="width: 40px;" class="text-center" data-th="Price">Rp.{{ $details['harga'] }},-<input type="hidden" name="harga[]" value="{{ $details['harga']}}"></td>
                            <td class="text-center" data-th="Quantity">{{ $details['kuantitas'] }}<input type="hidden" name="jumlah[]" value="{{ $details['kuantitas']}}"></td>
                            <td style="width: 40px;" class="text-center" data-th="Subtotal" class="text-center">Rp.<span class="product-subtotal" name="subtotal[]" value="{{ $details['harga'] * $details['kuantitas'] }}">{{ $details['harga'] * $details['kuantitas'] }},-</span><input type="hidden" name="subtotal[]" value="{{ $details['harga'] * $details['kuantitas'] }}"></td>
                            <td class="text-center" class="actions" data-th="">
                                {{-- <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button> --}}
                                <button class="btn btn-danger btn-sm remove-from-cart" data-item-remove-id_stok="{{ $details['id_stok'] }}"><i class="fa fa-trash-o"></i></button>
                                {{ $details['id_stok'] }}
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" class="font-weight-bold">Total</td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Rp.<span class="cart-total">{{ $total }}</span></strong><input type="hidden" name="total" value="{{ $total }}">,-</td>
                    <td colspan="1" class="hidden-xs"></td>
                </tr>
                </tfoot>
            </table>
                <button class="btn btn-success mb-3" type="submit">Selesai Transaksi</button>
            </form>
        </div>
    </div>
    <br>
    <div class="card">
        {{-- <select class="form-control" id="exampleFormControlSelect1">
            @foreach ($stok as $b)
        <option value="{{$b->id_stok}}">{{$b->nama_barang}}</option>
            @endforeach
        </select> --}}
        <div class="container">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stok as $stok)
                    <tr>
                        <th style="width: 10px;"> {{ $loop->iteration }} </th>
                        <td class="text-center kategori" id="nama_barang">{{ $stok->nama_barang }}</td>
                        <td class="text-center stok" id="stok">{{ $stok->sisa_stok }}</td>
                        <td>
                            <p class="btn-holder text-center"><a href="javascript:void(0);" data-item-id_stok="{{ $stok->id_stok }}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading fa-spinner" style="font-size:14px; display: none"></i>
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                    $("span#status").html('<div class="alert alert-success">'+'Produk Berhasil Ditambahkan'+'</div>');
                    $("#header-bar").html(response.data);
                    location.reload();
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

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

           // var parent_row = ele.parents("tr");

            var cart_total = $(".cart-total");


                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-item-remove-id_stok")},
                    dataType: "json",
                    success: function (response) {
                        location.reload();
                        // parent_row.remove();
                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                        $("#header-bar").html(response.data);
                        cart_total.text(response.total);
                    }
                });
        });
    </script>

@stop
