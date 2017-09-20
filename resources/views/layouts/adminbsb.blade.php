<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    @section('htmlheader')
        @include('layouts.partials.adminbsb.head-online')
        @include('layouts.partials.token')
    @show
    <body @isset($color) class="theme-{{ $color }}"@endisset>
        @include('layouts.partials.adminbsb.page-loader')
        <div class="overlay"></div>{{-- Overlay For Sidebars --}}
        @include('layouts.partials.adminbsb.searchbar')
        @include('layouts.partials.adminbsb.navbar')
        <div id="app-{{ Request::segment(1) }}">
            <section>
                @include('layouts.partials.adminbsb.left-sidebar')
            </section>
            <section class="content">
                @yield('main-content')
                @yield('modal')
            </section>
        </div>
        @section('scripts')
            @stack('vuejs-script')
            @include('layouts.partials.adminbsb.scripts-online')
            @stack('scripts')
        @show
    </body>
</html>