<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">{{-- Tell the browser to be responsive to screen width --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#222222" />{{-- Browser Color --}}
    <meta name="msapplication-navbutton-color" content="#222222" />{{-- URL Theme Color for Windows Phone --}}
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#222222" />{{-- URL Theme Color for iOS Safari --}}
    <title>@hasSection('htmlheader_title')@yield('htmlheader_title') {{ '|' }} @endif{{ config('app.name') }}</title>
    {{-- <link href="{{ asset('img/user.png') }}" rel="shortcut icon"> --}}
    <link href="{{ asset('css/roboto.css') }}" rel="stylesheet" type="text/css">{{-- Google Font Offline --}}
    <link href="{{ asset('css/materialicons.css') }}" rel="stylesheet" type="text/css">{{-- Material Icons Offline --}}
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">{{-- Bootstrap Core Css --}}
    <link href="{{ asset('plugins/node-waves/waves.min.css') }}" rel="stylesheet" />{{-- Waves Effect Css --}}
    <link href="{{ asset('plugins/animate-css/animate.min.css') }}" rel="stylesheet" />{{-- Animation Css --}}    
    <link href="{{ asset('css/style-adminbsb.css') }}" rel="stylesheet">{{-- Custom Css --}}
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />{{-- Theme --}}
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />{{-- Bootstrap Select 1.10.0 --}}
    @stack('styles')
</head>