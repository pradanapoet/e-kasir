<html>
<head>
	<title>Barcode</title>
</head>
<body>

        <?php
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            // $barcode = $generator->getBarcode($id_stok, $generator::TYPE_CODE_128);
            file_put_contents('barcode.png', $generator->getBarcode($id_stok, $generator::TYPE_CODE_128));
        ?>
        @for($i = 0; $i < 50; $i++)
        <p style="display: inline-block;">
            <span>
                <b> Nama Barang </b>
            </span>
            <span>
                <img style="margin-top:10px;" src="barcode.png">
            </span>
            <span>
                <a style="align-text:center;">{{$id_stok}}</a>
            </span>
        </p>
        {{-- <div style="display: inline;">
            <i>Nama barang</i><br>
            <img style="margin-top:10px;" src="barcode.png">
            {{-- <br><a style="align-text:center;">{{$id_stok}}</a>
        </div> 
        &nbsp;           --}}
        @endfor
</body>
</html>