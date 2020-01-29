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
                </table>
            </div>
        </div>
    </div>
@endsection