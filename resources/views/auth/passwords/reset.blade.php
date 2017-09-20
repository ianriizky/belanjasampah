@extends('layouts.venedor')

@section('htmlheader_title', 'Reset Password')

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Reset Password</li>
        </ul>
    </div>
</div>
@endpush

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="content-title">
                <h1 class="title">Reset Password</h1>
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
                <form method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <label class="text-center">Reset password anda disini.</label>
                    {{-- email --}}
                    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">E-mail&#42;</span></span>
                        <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control input-lg" placeholder="Masukkan e-mail anda" required>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                    {{-- password --}}
                    <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Password&#42;</span></span>
                        <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control input-lg" placeholder="Masukkan password anda" required>
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                    {{-- retype password --}}
                    {{-- password --}}
                    <div class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Ulangi Password&#42;</span></span>
                        <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control input-lg" placeholder="Masukkan ulang password anda" required>
                    </div>
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
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