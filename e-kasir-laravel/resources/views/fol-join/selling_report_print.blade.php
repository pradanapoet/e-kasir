<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Laporan Penjualan</title>

    <!-- Bootstrap & CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body onload="window.print()">
    <?php $total_pem = 0 ?>
    <?php $total_pemasukan = 0 ?>
    @foreach ($transaksi as $t)
        <?php $total_pem += $t->total ?>
    @endforeach
    <?php $total_pemasukan = number_format($total_pem,2,",",".") ?>

    <style>
        table {
        font-family: arial, sans-serif;
        font-size: 12dp;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }
    </style>

    <div class="container ml-3 window.print()" >
        <div class="row">
            <div class="col-12 text-center">
                <h3>Laporan Penjualan</h3>
                <h6>CV. Mitra Informatika Mojokerto</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <i style="font-size:10dp">Dicetak Pada : {{ $carbon->toDateTimeString() }}</i>
            </div>
            <div class="col-6">
                <a class="float-right btn btn-outline-dark" href="@if (auth()->user()->role=='pemilik') /lap_penjualan_pemilik @else /lap_penjualan_kasir @endif" id="btn-kembali">Kembali</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <table>
                    <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th class="text-center">Nomor Transaksi</th>
                        <th class="text-center">Tgl Transaksi</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaksi as $trs)
                    <tr>
                        <td style="width: 10px;"> {{ $loop->iteration }} </td>
                        <td class="text-center">{{$trs->id_transaksi}}</td>
                        <td class="text-center">{{$trs->created_at}}</td>
                        <td class="text-center"><input type="hidden" value="{{ $trs->total }}" class="form-control" name="total">{{$trs->total}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="font-weight-bold">Total</td>
                        <td colspan="2" class="hidden-xs text-center"><strong>Rp.<span class="cart-total">{{ $total_pemasukan }}</span></strong>,-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</body>
</html>
