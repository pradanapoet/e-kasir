@extends('fol-layout/main')

@section('title', 'Laporan Penjualan')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <?php $total_pem = 0 ?>
    <?php $total_pemasukan = 0 ?>
    @foreach ($transaksi as $t)
        <?php $total_pem += $t->total ?>
    @endforeach
    <?php $total_pemasukan = number_format($total_pem,2,",",".") ?>

    <div class="container">
        <h3>Laporan Penjualan</h3>
        <div class="card shadow">
            <a class="btn btn-info shadow" style="width:50px; margin-top:20px; margin-left:25px;" href="/lap_penjualan_pemilik_print"><i class="fas fa-print"></i></a>
            <div class="container mt-4 mb-4">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th class="text-center">Tgl Transaksi</th>
                                <th class="text-center">Total</th>
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
                            </form>
                            </tr>
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