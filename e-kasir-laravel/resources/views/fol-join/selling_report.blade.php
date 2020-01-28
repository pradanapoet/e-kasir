@extends('fol-layout/main')

@section('title', 'Laporan Penjualan')

@section('user')
    {{ auth()->user()->name }}
@endsection

@section('content')
    <div class="container">
        <h3>Laporan Penjualan</h3>
        <div class="card">
            <div class="container">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Tgl Transaksi</th>
                            <th>Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $trs)
                        <tr>
                            <td style="width: 10px;"> {{ $loop->iteration }} </td>
                            <td>{{$trs->created_at}}</td>
                            <td>{{$trs->total}}</td>
                        <td class="text-center"><a class="btn btn-sm btn-info fas fa-info" href="detail_lap_penjualan/{{ $trs->id_transaksi }}"></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection