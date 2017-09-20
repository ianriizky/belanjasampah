<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>        
            <a class="navbar-brand" href="/{{ Request::segment(1) }}">{{ config('app.name') }} - {{ ucfirst(Request::segment(1)) }}</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @include('layouts.partials.adminbsb.notification')
                <li><a href="/" title="Kembali ke Beranda"><i class="material-icons">home</i></a></li>
                {{-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> --}}
            </ul>
        </div>
    </div>
</nav>