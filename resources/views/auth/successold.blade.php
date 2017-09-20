@extends('layouts.basic')

@section('htmlheader_title', 'Confirm success')

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
                <p class="text-center">Selamat! akun <b>{{ $user->id }}</b> telah berhasil dikonfirmasi</p>
                <a href="/" class="btn btn-block btn-lg bg-pink waves-effect">KEMBALI KE BERANDA</a>
            </div>
        </div>
    </div>
</body>
@endsection