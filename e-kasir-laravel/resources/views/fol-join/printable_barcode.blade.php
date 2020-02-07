<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcode</title>

    <!-- Bootstrap & CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body onload="window.print()">
    <?php
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($id_stok, $generator::TYPE_CODE_128);
            file_put_contents('barcode.png', $generator->getBarcode($id_stok, $generator::TYPE_CODE_128));
            // $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
            // $barcode = $generator->getBarcode($id_stok, $generator::TYPE_CODE_128);
    ?>

    <style>
        table {
            font-family: arial, sans-serif;
            font-size: 12dp;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>

    <div class="container ml-3 window.print()">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Barcode</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a class="float-right btn btn-outline-dark"
                    href="@if (auth()->user()->role=='pemilik') /liststok_pemilik @else /liststok_kasir @endif"
                    id="btn-kembali">Kembali</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <table>
                    <thead>
                        <?php $j = 5; ?>
                        @for($i = 0; $i < $jumlah; $i+=5) <tr>
                            @for($j = 0; $j<5 ; $j++) <th class="text-center">{{$nama_barang}}<br><img
                                    class="text-center" style="margin-top:10px;" src="barcode.png"><br>{{$id_stok}}</th>
                                @endfor
                                </tr>
                                @endfor
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>