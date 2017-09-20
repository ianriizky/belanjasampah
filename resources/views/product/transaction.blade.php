@extends('layouts.venedor')

@section('htmlheader_title', ucfirst(Request::segment(1)))

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Beranda</a></li>
            <li class="active">Transaksi</li>
        </ul>
    </div>
</div>
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush

@section('main-content')
@include('flash::message')
<div class="container">
    <div class="row">
        <form action="{{ url('transaksi/proses') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="koperasi_id" value="{{ $good->koperasi_id }}">
            <input type="hidden" name="good_id" value="{{ $good->id }}">
            <input type="hidden" name="damount" value="{{ $quantity }}">
            <input type="hidden" name="dprice" value="{{ $good->price }}">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table checkout-table">
                        <thead>
                            <tr>
                                <th class="table-title">Nama Produk</th>
                                <th class="table-title">ID Produk</th>
                                <th class="table-title">Harga Per Unit</th>
                                <th class="table-title">Jumlah</th>
                                <th class="table-title">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="item-name-col">
                                    <figure>
                                        <a href="#"><img src="{{ $good->picture }}" alt="{{ $good->name }}"></a>
                                    </figure>
                                    <header class="item-name"><a href="javascript:void(0);">{{ $good->name }}</a></header>
                                </td>
                                <td class="item-code">{{ $good->id }}</td>
                                <input type="hidden" name="good_id" value="{{ $good->id }}">
                                <td class="item-price-col"><span class="item-price-special">Rp{{ $good->price }}</span></td>
                                <td>
                                    {{ $quantity }}
                                </td>
                                <td class="item-total-col">
                                    <span class="item-price-special">Rp{{ $subtotal }}</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="checkout-total-title" colspan="4"><strong>TOTAL:</strong></td>
                                <td class="checkout-total-price cart-total"><strong>Rp{{ $subtotal }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>{{-- End .table-reponsive --}}
                <div class="lg-margin"></div><!-- space -->
                <div class="text-right">
                    <a href="{{ URL::previous() }}"><button class="btn btn-default">BATAL</button></a>
                    <input type="submit" class="btn btn-custom-2" value="Konfirmasi Transaksi">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection