@extends('fol-layout/main')

@section('title', 'Laporan Keuntungan')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')

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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{ $keuntungan }},-</div>
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
                {{ $status_sort }}
                    @if ($status_sort=='belum')
                        <a class="btn btn-info shadow float-right d-inline" style="width:50px; margin-top:20px; margin-left:25px;" href="/lap_laba_pemilik_print"><i class="fas fa-print"></i></a>
                    @else
                    <form method="post" action="/lap_laba_pemilik_print_sorted">
                        @csrf
                        <div><input type="hidden" name="dari" value="{{$dari}}" class="form-control" required></div>
                        <div><input type="hidden" name="sampai" value="{{$sampai}}" class="form-control" required></div>
                        <button type="submit" class="btn btn-info shadow float-right d-inline" style="width:50px; margin-top:20px; margin-left:25px;"><i class="fas fa-print"></i></button>
                    </form>
                    @endif
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