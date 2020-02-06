<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Laporan Barang</title>

    <!-- Bootstrap & CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

    <?php $total_p = 0 ?>
    <?php $total_pengeluaran = 0 ?>
    @foreach ($stok as $as)
        <?php $total_p += $as->harga_beli * $as->jumlah_stok_masuk ?>
    @endforeach
    <?php $total_pengeluaran = number_format($total_p,2,",",".") ?>

    <?php $total_pem = 0 ?>
    <?php $total_pemasukan = 0 ?>
    @foreach ($transaksi as $t)
        <?php $total_pem += $t->total ?>
    @endforeach
    <?php $total_pemasukan = number_format($total_pem,2,",",".") ?>

    <?php $untung = $total_pem - $total_p ?>
    <?php $keuntungan = number_format($untung,2,",",".") ?>

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
                <h3>Laporan Keuntungan</h3>
                <h6>CV. Mitra Informatika Mojokerto</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <i style="font-size:10dp">Dicetak Pada : {{ $carbon->toDateTimeString() }}</i> 
            </div>
            <div class="col-6">
                <a class="float-right btn btn-outline-dark" href="/lap_barang_pemilik" id="btn-kembali">Kembali</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <table>
                    <thead>
                    <tr>
                        <th scope="col">Sumber</th>
                        <th class="text-center" scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class=" kategori" id="nama_barang">Total Pengeluaran</td>
                        <td class="text-center kategori" id="tanggal_masuk">Rp.{{ $total_pengeluaran }},-</td>
                    </tr>
                    <tr>
                        <td class=" kategori" id="nama_barang">Total Pemasukan</td>
                        <td class="text-center kategori" id="tanggal_masuk">Rp.{{ $total_pemasukan }},-</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="font-weight-bold">Total Keuntungan</td>
                        <td colspan="1" class="hidden-xs text-center"><strong>Rp.<span class="cart-total">{{ $untung }}</span></strong>,-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h3>Laporan Pengeluaran</h3>
                <table>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Tanggal Kadaluarsa</th>
                        <th scope="col">Barang Masuk</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Sub-Total</th>
                        <th scope="col">Status</th>
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
                        <td>{{ $stok->harga_beli }}</td>
                        <td>{{ $stok->harga_beli * $stok->jumlah_stok_masuk}}</td>
                        <td>{{ $stok->status }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="font-weight-bold">Total</td>
                        <td colspan="3" class="hidden-xs text-center"><strong>Rp.<span class="cart-total">{{ $total_pengeluaran }}</span></strong>,-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h3>Laporan Pemasukan</h3>
                <table>
                    <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th class="text-center">Tgl Transaksi</th>
                        <th class="text-center">Sub-Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaksi as $trs)
                    <tr>
                        <td style="width: 10px;"> {{ $loop->iteration }} </td>
                        <td class="text-center">{{$trs->created_at}}</td>
                        <td class="text-center"><input type="hidden" value="{{ $trs->total }}" class="form-control" name="total">{{$trs->total}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="font-weight-bold">Total</td>
                        <td colspan="1" class="hidden-xs text-center"><strong>Rp.<span class="cart-total">{{ $total_pemasukan }}</span></strong>,-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>    
</body>
</html>
