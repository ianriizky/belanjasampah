@extends('layouts.basic')

@section('htmlheader_title', 'Login')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('js/admin.js') }}"></script>{{-- Custom Js --}}
<script>
    $('#flash-overlay-modal').modal();
</script>
@endpush

@section('main-content')
@include('flash::message')
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="/">{{ config('app.name') }}</a>
            {{-- <small>blablabla</small> --}}
        </div>
        <div class="card">
            <div class="body">
                <form role="form" action="{{ route('login') }}" id="sign_in" method="POST">
                    {{ csrf_field() }}
                    {{-- <div class="msg">Login disini untuk masuk ke sistem</div> --}}
                    {{-- Username/id --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line{{ $errors->has('id') ? ' error' : '' }}">
                            <input type="text" id="id" name="id" class="form-control" placeholder="Username" value="{{ old('id') }}" required autofocus>
                        </div>
                        @if ($errors->has('id'))
                        <label id="id-error" class="error" for="id">{{ $errors->first('id') }}</label>
                        @endif
                    </div>
                    {{-- Password --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line{{ $errors->has('username') ? ' error' : '' }}">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                        </div>
                        @if ($errors->has('password'))
                        <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                        @endif
                    </div>
                    {{-- Remember Me --}}
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" id="remember" name="remember" class="filled-in chk-col-pink" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Ingat saya</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">MASUK</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{ url('/register') }}">Daftar Sekarang!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}">Lupa Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</body>
@endsection