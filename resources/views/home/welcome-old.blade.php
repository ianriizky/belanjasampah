@extends('layouts.basic')

@push('styles')
<style type="text/css">
html, body {
    background-color: #03A9F4;
    color: #636b6f;
    font-weight: 100;
    height: 100vh;
    margin: 0;
}

.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
    text-align: center;
}

.title {
    color: #ffffff;
    font-size: 84px;
}

.links > a {
    color: #ffffff;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
}

.m-b-md {
    margin-bottom: 30px;
}
</style>
@endpush

@push('scripts')
<script>
    $('#flash-overlay-modal').modal();
</script>
@endpush

@section('main-content')
@include('flash::message')
<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
            @if (auth()->check())
                @if (auth()->user()->hasRole('admin_sistem'))
                <a href="/sistem">Admin</a>
                @elseif(auth()->user()->hasRole('admin_koperasi'))
                <a href="/koperasi">Admin</a>
                @elseif(auth()->user()->hasRole('pegawai_bank'))
                <a href="/bank">Admin</a>
                @elseif(auth()->user()->hasRole('nasabah'))
                <a href="/nasabah">Cek transaksi</a>
                @endif                    
            @else
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endif
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                {{ config('app.name') }}
            </div>
        </div>
    </div>
</body>
@endsection