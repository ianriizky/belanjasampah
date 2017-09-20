@extends('layouts.venedor')

@section('htmlheader_title', 'E-mail confirm')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('js/admin.js') }}"></script>{{-- Custom Js --}}
@endpush

@section('main-content')
<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="/">{{ config('app.name') }}</a>
        </div>
        @if (session('status'))
            <div class="alert bg-orange">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="body">
                <p class="text-center">Silahkan cek email anda : <b>{{ $request->email }}</b> untuk proses konfirmasi akun</p>
                <a href="/" class="btn btn-block btn-lg bg-pink waves-effect">KEMBALI KE BERANDA</a>
            </div>
        </div>
    </div>
</body>
@endsection