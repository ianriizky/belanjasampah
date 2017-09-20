<head>
    <meta charset="UTF-8">
    <title>@hasSection('htmlheader_title')@yield('htmlheader_title') {{ '|' }} @endif{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">{{-- Tell the browser to be responsive to screen width --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Belanja apapun belinya pake sampah aja">
    <meta name="msapplication-navbutton-color" content="#14bfcc" />{{-- URL Theme Color for Windows Phone --}}
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#14bfcc" />{{-- URL Theme Color for iOS Safari --}}
    
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Gudea:400,700,400italic|Oswald:400,700,300|Roboto:400,700,300" rel="stylesheet" id="googlefont">
    
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">{{-- Bootstrap Core Css --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/style-venedor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive-venedor.css') }}">
    
    {{-- Favicon and Apple Icons (kosong) --}}
    {{-- <link rel="icon" type="image/png" href="images/icons/icon.png"> --}}
    <link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.png">
    
    {{-- - jQuery  --}}
    <script src="{{ asset('plugins/jquery-1.12.4/jquery.min.js') }}"></script>{{-- JQuery v1.12.4--}}
    {{-- <script>window.jQuery || document.write('<script src="js/jquery-1.11.1.min.js"><\/script>')</script> --}}

    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>