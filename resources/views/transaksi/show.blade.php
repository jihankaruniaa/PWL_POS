@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($penjualan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td colspan="3">{{ $penjualan->penjualan_id }}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td colspan="3">{{ $penjualan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td colspan="3">{{ $penjualan->pembeli }}</td>
                    </tr>
                    <tr>
                        <th>Kode penjualan</th>
                        <td colspan="3">{{ $penjualan->penjualan_kode }}</td>
                    </tr>
                        <th>Tanggal Pembelian</th>
                        <td colspan="3">{{ $penjualan->penjualan_tanggal}}</td>
                    </tr>
                @if($penjualan->detail->isNotEmpty())
                        <tr>
                            <th>Jumlah</th>
                            <td colspan="3">{{ $penjualan->detail->sum('jumlah')}}</td>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="4">Detail Barang</th>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Harga</th>
                        </tr>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach($penjualan->detail as $item)
                            <tr>
                                <td>{{ $item->barang->barang_nama }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->barang->harga_jual }}</td>
                                <td>{{ $jumlahHarga = $item->jumlah * $item->barang->harga_jual}}</td>
                            </tr>
                            @php
                                $totalPrice += $jumlahHarga;
                            @endphp
                        @endforeach
                        <tr>
                            <th class="text-center" colspan="3">TOTAL BAYAR</th>
                            <td>{{ $totalPrice }}</td>
                        </tr>
                    @endif
                </table>
            @endempty
            <a href="{{ url('transaksi') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush