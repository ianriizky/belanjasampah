<head>
    <meta charset="UTF-8">
    <title>@hasSection('htmlheader_title')@yield('htmlheader_title') {{ '|' }} @endif{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> {{-- Tell the browser to be responsive to screen width --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Belanja Sampah | Jual beli menggunakan tabungan dari bank sampah">
    <meta name="theme-color" content="#14bfcc" />{{-- Browser Color --}}
    <meta name="msapplication-navbutton-color" content="#14bfcc" /> {{-- URL Theme Color for Windows Phone --}}
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#14bfcc2" /> {{-- URL Theme Color for iOS Safari --}}
    
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Gudea:400,700,400italic|Oswald:400,700,300|Roboto:400,700,300" rel="stylesheet" id="googlefont">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> {{-- Bootstrap 3.3.7 --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"> {{-- Font Awesome 4.7.0 --}}
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/style-venedor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive-venedor.css') }}">
    
    {{-- Favicon and Apple Icons (kosong) --}}
    {{-- <link rel="icon" type="image/png" href="images/icons/icon.png"> --}}
    {{-- <link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.png"> --}}
    {{-- <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.png"> --}}
    
    {{-- - jQuery  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>{{-- JQuery 3.2.1 --}}
    {{-- <script>window.jQuery || document.write('<script src="js/jquery-1.11.1.min.js"><\/script>')</script> --}}

    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    
    @stack('styles')
</head>