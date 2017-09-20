@extends('layouts.venedor')

@section('htmlheader_title', ucfirst(Request::segment(1)))

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Beranda</a></li>
            <li class="active">{{ ucfirst(Request::segment(1)) }}</li>
        </ul>
    </div>
</div>
@endpush

@section('main-content')
@include('flash::message')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                    <div class="md-margin"></div><!-- .space -->
                    <div class="category-item-container">
                    <div class="row">
                        @if (!$goods->isEmpty())
                            @foreach ($goods as $good)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="item item-hover">
                                        <div class="item-image-wrapper">
                                            <figure class="item-image-container">
                                                <a href="{{ url('produk/'.$good->id) }}">
                                                    <img src="{{ $good->picture }}" class="item-image">
                                                    <img src="{{ $good->picture }}" class="item-image-hover">
                                                </a>
                                            </figure>
                                            <div class="item-price-container">
                                                <span class="item-price">Rp{{ $good->price }}</span>
                                            </div><!-- End .item-price-container -->
                                        </div><!-- End .item-image-wrapper -->
                                        <div class="item-meta-container">
                                            <h3 class="item-name"><a href="{{ url('produk/'.$good->id) }}">{{ $good->name }}</a></h3>
                                            <div class="item-action">
                                                <a href="{{ url('produk/'.$good->id) }}" class="item-add-btn">
                                                    <span class="icon-cart-text">Lihat Detail</span>
                                                </a>
                                            </div><!-- End .item-action -->
                                        </div><!-- End .item-meta-container --> 
                                    </div><!-- End .item -->
                                </div><!-- End .col-md-4 -->
                            @endforeach
                        @else
                            <p>Maaf, barang kosong.</p>
                        @endif
                    </div><!-- End .row -->
                    </div><!-- End .category-item-container -->
                
                    
                </div><!-- End .col-md-9 -->
                
                <aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
                    <div class="widget">
                        <div class="panel-group custom-accordion sm-accordion" id="category-filter">
                            <div class="panel">
                                <div class="accordion-header">
                                    <div class="accordion-title"><span>Kategori</span></div><!-- End .accordion-title -->
                        <a class="accordion-btn opened"  data-toggle="collapse" data-target="#category-list-1"></a>
                                </div><!-- End .accordion-header -->
                    
                            <div id="category-list-1" class="collapse in">
                                <div class="panel-body">
                                    <ul class="category-filter-list jscrollpane">
                                        @foreach ($categories as $category)
                                            <li><a href="{{ url('produk/kategori/'.$category['id']) }}">{{ $category['name'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- End .panel-body -->
                            </div><!-- #collapse -->
                            </div><!-- End .panel -->
                        </div><!-- .panel-group -->
                    </div><!-- End .widget -->
                    
                </aside><!-- End .col-md-3 -->
            </div><!-- End .row -->
            
            
        </div><!-- End .col-md-12 -->
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection