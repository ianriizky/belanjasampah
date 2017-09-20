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
<div class="lg-margin"></div>{{-- Space --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 main-content">
                    <div class="lg-margin"></div>{{-- space --}}
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <header class="content-title">
                                <h2 class="title">Apa itu Belanja Sampah?</h2>
                            </header>
                            <p>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Belanja sampah adalah sebuah sistem informasi yang memungkinkan nasabah dari bank sampah untuk berbelanja di koperasi serba usaha menggunakan saldo tabungan yang mereka miliki.
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nantinya sistem informasi ini mampu memfasilitasi transaksi belanja yang dilakukan oleh nasabah yang didukung dengan penggunaan sistem berbasis web sehingga memudahkan para nasabah dalam berbelanja barang kebutuhan sehari-hari.
                            </p>
                        </div>{{-- End .col-md-6 --}}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="sm-margin visible-xs"></div>{{-- space --}}
                            <img src="{{ asset('img/logo.png') }}" alt="Belanja Sampah" class="img-responsive">
                        </div>{{-- End .col-md-5 --}}
                    </div>{{-- End .row --}}
                    <div class="xlg-margin"></div>{{-- space --}}
                </div>{{-- End .col-md-12 --}}
            </div>{{-- End .row --}}
        </div>{{-- End .col-md-12 --}}
    </div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection