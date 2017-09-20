@extends('layouts.venedor')

@section('htmlheader_title', 'Login')

@push('breadcrumbs')
<div id="breadcrumb-container">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="/">Home</a></li>
			<li class="active">Login</li>
		</ul>
	</div>
</div>
@endpush

@section('main-content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <header class="content-title">
                <h1 class="title">Login</h1>
                <p class="title-desc">Jika anda belum memiliki akun, silahkan mendaftar <a href="{{ url('/register') }}">disini</a>.</p>
            </header>
		   	<div class="row">
			   	<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
			   		<div class="xs-margin"></div>
					<form id="login-form" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						{{-- Username --}}
                        <div class="input-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Username</span></span>
                            <input type="text" id="id" name="id" value="{{ old('id') }}" class="form-control input-lg" placeholder="Username" required autofocus>
                        </div>
                        @if ($errors->has('id'))
                        <span class="help-block">{{ $errors->first('id') }}</span>
                        <div class="sm-margin"></div>{{-- space --}}
                        @endif
                        {{-- Password --}}
                        <div class="input-group xs-margin{{ $errors->has('id') ? ' has-error' : '' }}">
                            <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Password</span></span>
                            <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control input-lg" placeholder="Password" required>
                        </div>
                        @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                        <div class="sm-margin"></div>{{-- space --}}
                        @endif
                        <div class="checkbox">
                         	<label>
                        		<input type="checkbox" id="remember" name="remember"{{ old('remember') ? ' checked' : '' }}>
                        		Ingat saya
                        	</label>
                        </div>
                        <div class="sm-margin"></div>{{-- space --}}
	                    <button type="submit" class="btn btn-custom-2 btn-block">MASUK</button>
                    </form>
                    <div class="sm-margin"></div>{{-- space --}}
                    <span>Lupa password? Klik <a href="{{ route('password.request') }}">disini</a>.</span>
			   	</div>{{-- End .col-md-6 --}}
		   </div>{{-- End.row --}}
		</div>{{-- End .col-md-12 --}}
	</div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection