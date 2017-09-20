@extends('layouts.venedor')

@section('htmlheader_title', 'Konfirmasi Akun')

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Beranda</a></li>
            <li><a href="/register">Daftar</a></li>
            <li class="active">Konfirmasi Akun</li>
        </ul>
    </div>
</div>
@endpush

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="content-title">
                <h1 class="title">Konfirmasi akun</h1>
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="xs-margin"></div><!-- space -->
            <p class="text-center">Silahkan cek email anda (<b>{{ $request->email }}</b>) untuk proses konfirmasi akun</p>
            <a href="/"><button type="button" class="btn btn-success btn-block">Kembali ke Beranda</button></a>
        </div>{{-- End .col-md-12 --}}
    </div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection