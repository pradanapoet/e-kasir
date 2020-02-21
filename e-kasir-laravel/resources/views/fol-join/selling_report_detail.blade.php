@extends('fol-layout/main')

@section('title', 'Detail Laporan Penjualan')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')
<div class="container">
    <h3>Detail Laporan Penjualan</h3>
    <div class="card">
        <div class="card-body">
            <div class="container">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail_transaksi as $dtrs)
                        <tr>
                            <?php $harga = number_format($dtrs->harga,2,",",".")?>
                            <?php $subtotal = number_format($dtrs->subtotal,2,",",".")?>
                            <td style="width: 10px;"> {{ $loop->iteration }} </td>
                            <td>{{$dtrs->nama_barang}}</td>
                            <td>Rp. {{$harga}}</td>
                            <td>{{$dtrs->jumlah}}</td>
                            <td>Rp. {{$subtotal}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <?php $total1 = number_format($total,2,",",".")?>
                            <td colspan="2" class="font-weight-bold">Total</td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs"><strong>Rp.<span class="cart-total">{{ $total1 }}</span></strong>,-
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection