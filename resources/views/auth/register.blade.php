@extends('layouts.venedor')

@section('htmlheader_title', 'Daftar')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.selectbox.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/jquery-selectbox/jquery.selectbox.min.js') }}"></script>
@endpush

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Beranda</a></li>
            <li class="active">Daftar</li>
        </ul>
    </div>
</div>
@endpush

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="content-title">
                <h1 class="title">Daftar</h1>
                <p class="title-desc">Jika anda sudah memiliki akun, silahkan login <a href="{{ url('login') }}">disini</a>.</p>
            </header>
            <div class="xs-margin"></div><!-- space -->
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="xs-margin"></div>
                <form id="login-form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <label>Silahkan pilih jenis usaha yang ingin anda daftarkan</label>
                    <div class="normal-selectbox clearfix">
                        <select id="roles" name="roles" class="selectbox">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>{{--  End .normal-selectbox  --}}
                    <div class="sm-margin"></div>{{-- space --}}
                    <button type="submit" class="btn btn-custom-2 btn-block">DAFTAR</button>
                    <div class="lg-margin"></div>{{-- space --}}
                </form>
            </div>{{-- End .col-md-6 --}}
        </div>{{-- End .col-md-12 --}}
    </div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection