<aside id="leftsidebar" class="sidebar">
    {{-- User Info --}}
    @if (Request::segment(1) == 'sistem')
        <div class="user-info" style="background: url({{ asset('img/bg.jpg') }}) no-repeat no-repeat;">
    @elseif (Request::segment(1) == 'koperasi')
        <div class="user-info" style="background: url({{ asset('img/bg2.jpg') }}) no-repeat no-repeat;">
    @elseif (Request::segment(1) == 'bank')
        <div class="user-info" style="background: url({{ asset('img/bg3.jpg') }}) no-repeat no-repeat;">
    @elseif (Request::segment(1) == 'nasabah')
        <div class="user-info" style="background: url({{ asset('img/bg4.png') }}) no-repeat no-repeat;">
    @endif    
        <div class="image">
            <img src="{{ auth()->user()->picture }}" width="48" height="48" alt="{{ auth()->user()->id }}" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</div>
            <div class="email">{{ auth()->user()->email }}</div>
        </div>
    </div>
    {{-- #User Info --}}
    {{-- Menu --}}
    <div class="menu">
        <ul class="list">
            @if (Request::segment(1) == 'sistem')
                <li class="header">BERANDA</li>
                <router-link tag="li" to="/" exact>
                    <a>
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </router-link>
                @include('layouts.partials.adminbsb.sistem-sidebar')
                <li class="header">AKUN</li>
                <router-link tag="li" to="/profil">
                    <a>
                        <i class="material-icons">person_pin</i>
                        <span>Profil</span>
                    </a>
                </router-link>
            @elseif (Request::segment(1) == 'koperasi')
                @if ($koperasi->active == 1) {{-- jika koperasi aktif --}}
                    <li class="header">BERANDA</li>
                    <router-link tag="li" to="/" exact>
                        <a>
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </router-link>
                    @include('layouts.partials.adminbsb.koperasi-sidebar')
                    <li class="header">AKUN</li>
                    <router-link tag="li" to="/profil">
                        <a>
                            <i class="material-icons">person_pin</i>
                            <span>Profil</span>
                        </a>
                    </router-link>
                @else {{-- jika koperasi tidak aktif --}}
                    <li class="header">AKUN</li>
                @endif
            @elseif (Request::segment(1) == 'bank')
                @if ($bank->active == 1) {{-- jika bank aktif --}}
                    <li class="header">BERANDA</li>
                    <router-link tag="li" to="/" exact>
                        <a>
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </router-link>
                    @include('layouts.partials.adminbsb.bank-sidebar')
                    <li class="header">AKUN</li>
                    <router-link tag="li" to="/profil">
                        <a>
                            <i class="material-icons">person_pin</i>
                            <span>Profil</span>
                        </a>
                    </router-link>
                @else {{-- jika bank tidak aktif --}}
                    <li class="header">AKUN</li>
                @endif
            @elseif (Request::segment(1) == 'nasabah')
                @if ($nasabah->active == 1) {{-- jika bank aktif --}}
                    <li class="header">BERANDA</li>
                    <router-link tag="li" to="/" exact>
                        <a>
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </router-link>
                    @include('layouts.partials.adminbsb.nasabah-sidebar')
                    <li class="header">AKUN</li>
                    <router-link tag="li" to="/profil">
                        <a>
                            <i class="material-icons">person_pin</i>
                            <span>Profil</span>
                        </a>
                    </router-link>
                @else {{-- jika bank tidak aktif --}}
                    <li class="header">AKUN</li>
                @endif
            @endif
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
    {{-- #Menu --}}
    {{-- Footer --}}
    @include('layouts.partials.adminbsb.footer')
    {{-- #Footer --}}
</aside>