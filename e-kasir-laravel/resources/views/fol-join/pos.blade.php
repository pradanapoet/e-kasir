@extends('fol-layout/main')

@section('title', 'POS')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')
<span id="status"></span>
Halaman POS Boss
<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="container">

                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="text-center">Subtotal</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $total = 0 ?>

                        @if(session('cart'))
                            @foreach((array) session('cart') as $id => $details)

                                <?php $total += $details['price'] * $details['quantity'] ?>

                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                                            <div class="col-sm-9">
                                                <h4 class="nomargin">{{ $details['nama'] }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">${{ $details['harga'] }}</td>
                                    <td data-th="Quantity">
                                        <input type="number" value="{{ $details['kuantitas'] }}" class="form-control quantity" />
                                    </td>
                                    <td data-th="Subtotal" class="text-center">$<span class="product-subtotal">{{ $details['price'] * $details['quantity'] }}</span></td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                                        <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                        <tfoot>
                        <tr class="visible-xs">
                            <td class="text-center"><strong>Total $<span class="cart-total">{{ $total }}</span></strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Total $<span class="cart-total">{{ $total }}</span></strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                {{-- <select class="form-control" id="exampleFormControlSelect1">
                    @foreach ($stok as $b)
                <option value="{{$b->id_stok}}">{{$b->nama_barang}}</option>
                    @endforeach
                  </select> --}}
                  <h4>iki stok</h4>
                  <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stok as $stok)
                        <tr>
                            <th scope="col">{{ $loop->iteration }}</th>
                            <td class="align-middle kategori" id="nama_barang">{{ $stok->nama_barang }}</td>
                            <td>{{ $stok->sisa_stok }}</td>
                            <td>
                            {{-- <button type="button" href="javascript:void(0);" class="badge badge-secondary add-to-cart" data-item-id_stok="{{$stok->id_stok}}">Tambah<i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i></button> --}}
                            <p class="btn-holder"><a href="javascript:void(0);" data-item-id_stok="{{ $stok->id_stok }}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none">jancok</i>
                            </p>
                            {{-- data-item-id_barang="{{$stok->id_barang}}" data-item-stok_masuk="{{$stok->jumlah_stok_masuk}}" data-item-tanggal_masuk="{{$stok->tanggal_masuk}}" data-item-tanggal_kadaluarsa="{{$stok->tanggal_kadaluarsa}}" data-item-sisa_stok="{{$stok->sisa_stok}}" data-item-harga_beli="{{$stok->harga_beli}}" data-item-harga_jual="{{$stok->harga_jual}}" --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
            $.ajax({
                url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-item-id_stok"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+'js sukses '+'</div>');
                    $("#header-bar").html(response.data);
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

            var parent_row = ele.parents("tr");

            var cart_total = $(".cart-total");

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    dataType: "json",
                    success: function (response) {

                        parent_row.remove();

                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                        $("#header-bar").html(response.data);

                        cart_total.text(response.total);
                    }
                });
            }
        });

    </script>

@stop
