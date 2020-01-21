@extends('fol-layout/main')

@section('title', 'POS')

@section('user')
{{ auth()->user()->name }}
@endsection

@section('content')

Halaman POS Boss
<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                cmiiw
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                {{-- <select class="form-control" id="exampleFormControlSelect1">
                    @foreach ($stok as $b)
                <option value="{{$b->id_stok}}">{{$b->nama_barang}}</option>
                    @endforeach
                  </select> --}}
                  <h4>iki stok</h4>
                  <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stok as $stok)
                        <tr>
                            <th scope="col">{{ $loop->iteration }}</th>
                            <td class="align-middle kategori" id="nama_barang">{{ $stok->nama_barang }}</td>
                            <td>{{ $stok->sisa_stok }}</td>
                            <td>
                            <button type="button" class="badge badge-secondary" id="detail-item" data-item-id_stok="{{$stok->id_stok}}" data-item-id_barang="{{$stok->id_barang}}" data-item-stok_masuk="{{$stok->jumlah_stok_masuk}}" data-item-tanggal_masuk="{{$stok->tanggal_masuk}}" data-item-tanggal_kadaluarsa="{{$stok->tanggal_kadaluarsa}}" data-item-sisa_stok="{{$stok->sisa_stok}}" data-item-harga_beli="{{$stok->harga_beli}}" data-item-harga_jual="{{$stok->harga_jual}}">Tambah</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
