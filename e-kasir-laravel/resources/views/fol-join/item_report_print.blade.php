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
                <h3>Laporan Barang</h3>
                <h6>CV. Mitra Informatika Mojokerto</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <i style="font-size:10dp">Dicetak Pada : {{ $carbon->toDateTimeString() }}</i>
            </div>
            <div class="col-6">
                <a class="float-right btn btn-outline-dark" href="@if (auth()->user()->role=='pemilik')/lap_barang_pemilik @else /lap_barang_kasir @endif" id="btn-kembali">Kembali</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <table>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Tanggal Kadaluarsa</th>
                        <th scope="col">Barang Masuk</th>
                        <th scope="col">Barang Terjual</th>
                        <th scope="col">Sisa Barang</th>
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
                        <td>{{$stok->jumlah_stok_masuk - $stok->sisa_stok }}</td>
                        <td>{{ $stok->sisa_stok }}</td>
                        <td>{{ $stok->status }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</body>
</html>
