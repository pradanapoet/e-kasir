<div class="container">
    <form action="/pos/store" method="POST">
        @csrf
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 10px;">#</th>
                    <th class="text-center">Product</th>
                    <th style="width: 40px;" class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th style="width: 40px;" class="text-center">Subtotal</th>
                    <th style="width: 30px;"></th>
                </tr>
            </thead>
            <tbody>

                <?php $total = 0 ?>

                @if(session('cart'))
                @foreach((array) session('cart') as $id => $details)

                <?php $total += $details['harga'] * $details['kuantitas'] ?>

                <tr>
                    <th style="width: 10px;" scope="col">{{ $loop->iteration }}</th>
                    <td data-th="Product">{{ $details['nama'] }}<input type="hidden" name="nama[]"
                            value="{{ $details['id_stok']}}"></td>
                    <td style="width: 40px;" class="text-center" data-th="Price">Rp.{{ $details['harga'] }},-<input
                            type="hidden" name="harga[]" value="{{ $details['harga']}}"></td>
                    <td class="text-center" data-th="Quantity">{{ $details['kuantitas'] }}<input type="hidden"
                            name="jumlah[]" value="{{ $details['kuantitas']}}"></td>
                    <td style="width: 40px;" class="text-center" data-th="Subtotal" class="text-center">Rp.<span
                            class="product-subtotal" name="subtotal[]"
                            value="{{ $details['harga'] * $details['kuantitas'] }}">{{ $details['harga'] * $details['kuantitas'] }},-</span><input
                            type="hidden" name="subtotal[]" value="{{ $details['harga'] * $details['kuantitas'] }}">
                    </td>
                    <td class="text-center" class="actions" data-th="">
                        {{-- <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i
                            class="fa fa-refresh"></i></button> --}}
                        {{-- <button class="btn btn-danger btn-sm remove-from-cart" data-item-remove-id_stok="{{ $details['id_stok'] }}"><i
                            class="fa fa-trash-o"></i></button> --}}
                        <a class="btn btn-danger btn-sm" style="width: 30px;"
                            href="remove-from-cart/{{ $details['id_stok'] }}"><i
                                class="far fa-trash-alt icon-size"></i></a>
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
                    <td class="hidden-xs text-center"><strong>Rp.<span
                                class="cart-total">{{ $total }}</span></strong><input type="hidden" name="total"
                            value="{{ $total }}">,-</td>
                    <td colspan="1" class="hidden-xs"></td>
                </tr>
            </tfoot>
        </table>
        <button class="btn btn-success mb-3" type="submit">Selesai Transaksi</button>
    </form>
</div>