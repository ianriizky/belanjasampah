@extends('layouts.venedor')

@section('htmlheader_title', ucfirst(Request::segment(1)))

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Beranda</a></li>
            <li><a href="{{ url('kategori') }}">{{ ucfirst(Request::segment(1)) }}</a></li>
            <li class="active">{{ $good->name }}</li>
        </ul>
    </div>
</div>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.carousel.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
{{-- <script src="{{ asset('plugins/jquery-elevateZoom/jquery.elevateZoom.min.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.js"></script> --}}
<script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
@endpush

@section('main-content')
@include('flash::message')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 product-viewer clearfix">
                    <div id="product-image-container">
                        <figure><img src="{{ $good->picture }}" data-zoom-image="{{ $good->picture }}" alt="{{ $good->name }}" id="product-image">
                            <figcaption class="item-price-container">
                                <span class="item-price">Rp{{ $good->price }}</span>
                            </figcaption>
                        </figure>
                    </div>{{-- product-image-container --}}
                </div>{{-- End .col-md-6 --}}
                <div class="col-md-6 col-sm-12 col-xs-12 product">
                    <div class="lg-margin visible-sm visible-xs"></div>{{-- Space --}}
                    <h1 class="product-name">{{ $good->name }}</h1>
                    <ul class="product-list">
                        <li><span>Tersedia :</span>{{ $good->stock }}</li>
                        <li><span>ID Produk :</span>{{ $good->id }}</li>
                        <li><span>Koperasi :</span>{{ $good->koperasi->name }}</li>
                    </ul>
                    <hr>
                    @if ($good->stock > 0)
                    <div class="product-add clearfix">
                        <form action="{{ url('produk/'.$good->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="custom-quantity-input">
                                <input type="hidden" name="good_id" value="{{ $good->id }}">
                                <input type="number" name="good_quantity" value="1" min="1" max="{{ $good->stock }}">
                                {{-- <input type="text" name="quantity" value="0"> --}}
                                {{-- <a href="#" onclick="return $('input[name=quantity]').value()+1;" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a> --}}
                                {{-- <a href="#" onclick="return --;" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a> --}}
                            </div>
                            <button type="submit" class="btn btn-custom-2 btn-xs">BELI SEKARANG</button>
                            {{-- <button type="button" class="btn btn-default btn-sm">TAMBAH KERANJANG</button> --}}                            
                        </form>
                    </div>{{-- .product-add --}}
                    @else
                    <div class="product-add clearfix">
                        <p>Maaf, stok habis.</p>
                    </div>
                    @endif
                    <div class="md-margin"></div>{{-- Space --}}
                </div>{{-- End .col-md-6 --}}
            </div>{{-- End .row --}}
            <div class="lg-margin2x"></div>{{-- End .space --}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="tab-container left product-detail-tab clearfix">
                        <ul class="nav-tabs">
                          <li class="active"><a href="#description" data-toggle="tab">Deskripsi</a></li>
                          <li><a href="#koperasi" data-toggle="tab">Detail Koperasi</a></li>
                        </ul>
                        <div class="tab-content clearfix">
                            <div class="tab-pane active" id="description">
                                <p>{{ $good->description == null ? 'Maaf, deskripsi produk tidak tersedia.' : $good->description }}</p>
                            </div>{{-- End .tab-pane --}}
                            <div class="tab-pane" id="koperasi">
                                <ul class="product-details-list">
                                    <li>Nama Koperasi : {{ $good->koperasi->name }}</li>
                                    <li>Alamat : {{ $good->koperasi->address == null ? '(tidak ada)' : $good->koperasi->address }}</li>
                                    @php
                                        setlocale(LC_TIME, 'Indonesian');
                                    @endphp
                                    <li>Bergabung sejak : {{ $good->koperasi->created_at->formatLocalized('%d %B %Y') }}</li>
                                </ul>
                            </div>{{-- End .tab-pane --}}
                        </div>{{-- End .tab-content --}}
                    </div>{{-- End .tab-container --}}
                    <div class="lg-margin visible-xs"></div>
                </div>{{-- End .col-xs-12 --}}
                <div class="lg-margin2x visible-sm visible-xs"></div>{{-- Space --}}
            </div>{{-- End .row --}}
        </div>{{-- End .col-md-12 --}}
    </div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection