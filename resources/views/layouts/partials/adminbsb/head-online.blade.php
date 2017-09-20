<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">{{-- Tell the browser to be responsive to screen width --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (Request::segment('1') == 'sistem')
    <meta name="theme-color" content="#3F51B5" />{{-- Browser Color --}}
    <meta name="msapplication-navbutton-color" content="#3F51B5" />{{-- URL Theme Color for Windows Phone --}}
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#3F51B5" />{{-- URL Theme Color for iOS Safari --}}
    @endif
    @if (Request::segment('1') == 'koperasi')
    <meta name="theme-color" content="#F44336" />{{-- Browser Color --}}
    <meta name="msapplication-navbutton-color" content="#F44336" />{{-- URL Theme Color for Windows Phone --}}
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#F44336" />{{-- URL Theme Color for iOS Safari --}}
    @endif
    @if (Request::segment('1') == 'bank')
    <meta name="theme-color" content="#4CAF50" />{{-- Browser Color --}}
    <meta name="msapplication-navbutton-color" content="#4CAF50" />{{-- URL Theme Color for Windows Phone --}}
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#4CAF50" />{{-- URL Theme Color for iOS Safari --}}
    @endif
    <title>@hasSection('htmlheader_title')@yield('htmlheader_title') {{ '|' }} @endif{{ config('app.name') }}</title>
    {{-- <link href="{{ asset('img/user.png') }}" rel="shortcut icon"> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">{{-- Google Font Online --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">{{-- Material Icons Online --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> {{-- Bootstrap 3.3.7 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.5/waves.min.css" rel="stylesheet" />{{-- Waves Effect Css 0.7.5 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" />{{-- Animation Css 3.5.2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css" rel="stylesheet">{{-- Bootstrap Select 1.12.3 --}}
    <link href="{{ asset('css/style-adminbsb.css') }}" rel="stylesheet">{{-- Custom Css --}}
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />{{-- Theme --}}
    @stack('styles')
</head>