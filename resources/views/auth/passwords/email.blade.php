@extends('layouts.venedor')

@section('htmlheader_title', 'Lupa Password')

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Lupa Password</li>
        </ul>
    </div>
</div>
@endpush

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="content-title">
                <h1 class="title">Lupa Password</h1>
                <p class="title-desc">Silahkan login <a href="{{ url('login') }}">disini</a>.</p>
            </header>
            <div class="xs-margin"></div><!-- space -->
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="xs-margin"></div>
                @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="text-center">{{ session('status') }}</span>
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <label class="text-center">Masukkan alamat email yang anda gunakan saat mendaftar.Kami akan mengirimkan email kepada anda dengan username dan link untuk mereset password anda.</label>
                    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">E-mail&#42;</span></span>
                        <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control input-lg" placeholder="Masukkan e-mail anda" required>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                    <div class="sm-margin"></div>{{-- space --}}
                    <button type="submit" class="btn btn-custom-2 btn-block">RESET</button>
                    <div class="lg-margin"></div>{{-- space --}}
                </form>
            </div>{{-- End .col-md-6 --}}
        </div>{{-- End .col-md-12 --}}
    </div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection
