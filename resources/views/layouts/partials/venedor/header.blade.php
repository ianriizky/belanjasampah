<header id="header" class="header5">
    <div id="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (auth()->check())
                    <div class="header-top-left">
                        <ul id="top-links" class="clearfix">
                            @if (auth()->user()->hasRole('admin_sistem'))
                                <li><a href="/sistem"><span class="top-icon top-icon-user"></span><span class="hide-for-xs">Halaman Admin</span></a></li>
                            @elseif (auth()->user()->hasRole('admin_koperasi'))
                                <li><a href="/koperasi"><span class="top-icon top-icon-user"></span><span class="hide-for-xs">Halaman Admin</span></a></li>
                            @elseif (auth()->user()->hasRole('admin_bank'))
                                <li><a href="/bank"><span class="top-icon top-icon-user"></span><span class="hide-for-xs">Halaman Admin</span></a></li>
                            @elseif (auth()->user()->hasRole('nasabah'))
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                <li><a href="/nasabah"><span class="top-icon top-icon-user"></span><span class="hide-for-xs">Akun Saya</span></a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="top-icon top-icon-check"></span><span>Logout</span></a></li>
                                @php
                                    $customer = App\Customer::where('user_id', auth()->user()->id)->first();
                                @endphp
                                <li><a href="javascript:void(0);"><span>Saldo anda : Rp{{ $customer->balance }}</span></a></li>
                            @endif
                        </ul>
                    </div>{{-- End .header-top-left --}}
                    @endif
                    <div class="header-top-right">
                        <div class="header-top-dropdowns pull-right">
                            <div class="btn-group dropdown-language">
                                <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                    <span class="flag-container"><img src="{{ asset('img/indonesia-flag.png') }}" alt="flag of indonesia"></span>
                                    <span class="hide-for-xs">Indonesia</span>
                                </button>
                                {{-- <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#"><span class="flag-container"><img src="{{ asset('img/england-flag.png') }}" alt="flag of england"></span><span class="hide-for-xs">English</span></a></li>
                                </ul> --}}
                            </div>{{-- End .btn-group --}}
                        </div>{{-- End .header-top-dropdowns --}}
                        <div class="header-text-container pull-right">
                        @if (auth()->check())
                            <p class="header-link">Selamat datang, <a href="javascript:void(0);">{{ auth()->user()->id }}</a></p>
                        @else
                            <p class="header-link"><a href="{{ url('login') }}">Login</a> | <a href="{{ url('/register') }}">Daftar</a></p>
                        @endif
                        </div>{{-- End .pull-right --}}
                    </div>{{-- End .header-top-right --}}
                </div>{{-- End .col-md-12 --}}
            </div>{{-- End .row --}}
        </div>{{-- End .container --}}
    </div>{{-- End #header-top --}}
    <div id="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 logo-container">
                    <h1 class="logo clearfix">
                        <span>Belanja Sampah</span>
                        <a href="/" title="Belanja Sampah"><img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name')}}" width="204"></a>
                    </h1>
                </div>{{-- End .col-md-12 --}}
                <div class="col-md-12 col-sm-12 col-xs-12 header-inner-right">
                    {{-- <div id="quick-access">
                        <form id="search-form" name="search-form" class="form-inline quick-search-form" action="#">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Cari">
                            </div>End .form-inline
                            <button type="submit" id="quick-search" class="btn btn-custom"></button>
                        </form>
                    </div>End #quick-access --}}
                    {{-- <div class="dropdown-cart-menu-container pull-right">
                        <div class="btn-group dropdown-cart">
                            <span class="cart-menu-icon"></span>
                            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                0 barang <span class="drop-price">- Rp0,00</span>
                            </button>
                            <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                <p class="dropdown-cart-description">Baru ditambahkan</p>
                                <ul class="dropdown-cart-product-list">
                                    <li class="item clearfix">
                                        <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a>
                                        <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
                                        <figure>
                                            <a href="product.html"><img src="{{ asset('img/products/thumbnails/item12.jpg') }}" alt="phone 4"></a>
                                        </figure>
                                        <div class="dropdown-cart-details">
                                            <p class="item-name">
                                                <a href="product.html">Cam Optia AF Webcam </a>
                                            </p>
                                            <p>
                                                1x
                                                <span class="item-price">Rp49.900<span class="sub-price">,00</span></span>
                                            </p>
                                        </div>End .dropdown-cart-details
                                    </li>
                                </ul>
                                <ul class="dropdown-cart-total">
                                    <li>
                                        <span class="dropdown-cart-total-title">Total :</span>Rp98.800<span class="sub-price">,00</span>
                                    </li>
                                </ul>.dropdown-cart-total
                                <div class="dropdown-cart-action">
                                    <p><a href="cart.html" class="btn btn-custom-2 btn-block">Keranjang</a></p>
                                    <p><a href="checkout.html" class="btn btn-custom btn-block">Pembayaran</a></p>
                                </div>End .dropdown-cart-action
                            </div>End .dropdown-cart
                        </div>End .btn-group
                    </div>End .dropdown-cart-menu-container --}}
                </div>{{-- End .col-md-12 --}}
            </div>{{-- End .row --}}
        </div>{{-- End .container --}}
        @include('layouts.partials.venedor.navbar')
    </div>{{-- End #inner-header --}}
     {{-- @include('layouts.partials.venedor.login-modal') --}}
</header>{{-- End #header --}}