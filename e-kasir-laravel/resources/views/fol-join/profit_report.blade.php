@extends('fol-layout/main')

@section('title', 'Laporan Keuntungan')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
<?php $total_pengeluaran = 0 ?>
@foreach ($stok as $as)
    <?php $total_pengeluaran += $as->harga_beli * $as->jumlah_stok_masuk ?>
@endforeach

<?php $total_pemasukan = 0 ?>
@foreach ($transaksi as $t)
    <?php $total_pemasukan += $t->total ?>
@endforeach

<div class="container">
     <!-- Content Row -->
     <div class="row">

        <!-- Jumlah Barang Yang Dijual -->
        <div class="col-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pengeluaran :</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{$total_pengeluaran}},-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemasukan :</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{$total_pemasukan}},-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Keuntungan :</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{$total_pemasukan - $total_pengeluaran }},-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4>Rentan Pencarian</h4>
        </div>
        <div class="card-body">
            <div class="container mt-3">
                <form method="post" action="/lap_laba_pemilik">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group d-inline">
                                <label><i class="fas fa-calendar text-danger"></i> Dari Tanggal</label>
                                <input type="date" name="dari" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group d-inline">
                                <label><i class="fas fa-calendar text-danger"></i> Sampai Tanggal</label>
                                <input type="date" name="sampai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" value="CARI" name="cari" class="btn btn-sm btn-danger">
                        <a href="/lap_laba_pemilik" class="btn btn-sm btn-danger">RESET</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
        <h4>Laporan Pengeluaran</h4>@if($dari!=NULL)<h5 class="d-inline">( {{$dari}} - {{$sampai}} )</h5>@endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Tanggal Kadaluarsa</th>
                            <th scope="col">Barang Masuk</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Sub-Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
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
                            <td>{{$stok->harga_beli }}</td>
                            <td>{{$stok->harga_beli * $stok->jumlah_stok_masuk}}</td>
                            <td>{{ $stok->status }}</td>
                            <td>
                            <button type="button" class="badge badge-secondary" id="detail-item" data-item-id_stok="{{$stok->id_stok}}" data-item-id_barang="{{$stok->id_barang}}" data-item-stok_masuk="{{$stok->jumlah_stok_masuk}}" data-item-tanggal_masuk="{{$stok->tanggal_masuk}}" data-item-tanggal_kadaluarsa="{{$stok->tanggal_kadaluarsa}}" data-item-sisa_stok="{{$stok->sisa_stok}}" data-item-harga_beli="{{$stok->harga_beli}}" data-item-harga_jual="{{$stok->harga_jual}}">Detail</button>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="font-weight-bold">Total</td>
                        <td colspan="3" class="hidden-xs text-center"><strong>Rp.<span class="cart-total">{{ $total_pengeluaran }}</span></strong>,-</td>
                        {{-- <td colspan="2" class="hidden-xs"></td> --}}
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4 mt-4">
        <div class="card-header">
            <h4>Laporan Pemasukan</h4>@if($dari!=NULL)<h5 class="d-inline">( {{$dari}} - {{$sampai}} )</h5>@endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th class="text-center">Tgl Transaksi</th>
                            <th class="text-center">Sub-Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $trs)
                        <tr>
                        <form action="/detail_lap_penjualan" method="post" class="d-inline">
                        @csrf
                            <td style="width: 10px;"> {{ $loop->iteration }} </td>
                            <td class="text-center">{{$trs->created_at}}</td>
                            <td class="text-center"><input type="hidden" value="{{ $trs->total }}" class="form-control" name="total">{{$trs->total}}</td>
                            {{-- <td class="text-center"><a class="btn btn-sm btn-info fas fa-info" href="detail_lap_penjualan/{{ $trs->id_transaksi }}"></a></td> --}}
                            <td class="text-center">
                                <input type="hidden" value="{{ $trs->id_transaksi }}" class="form-control" name="id">
                                <button type="submit" class="btn btn-sm btn-info fas fa-info"></button>
                            </td>
                        </tr>
                    </form>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="font-weight-bold">Total</td>
                        <td colspan="2" class="hidden-xs text-center"><strong>Rp.<span class="cart-total">{{ $total_pemasukan }}</span></strong>,-</td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection