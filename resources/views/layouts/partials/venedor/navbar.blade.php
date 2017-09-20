<div id="main-nav-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix">
                <nav id="main-nav">
                    <div id="responsive-nav">
                        <div id="responsive-nav-button">
                            Menu <span id="responsive-nav-button-icon"></span>
                        </div>{{-- responsive-nav-button --}}
                    </div>
                    <ul class="menu clearfix">
                        <li><a href="/">Beranda</a>
                        <li><a href="javascript:void(0);">Produk</a>
                            <ul>
                                <li><a href="{{ url('produk') }}">Semua</a></li>
                                @php
                                    $categories = App\Category::whereActive(true)->get(['id', 'name'])->toArray();
                                @endphp
                                <li><a href="javascript:void(0);">Kategori</a>
                                    <ul>
                                    @foreach (array_slice($categories, 0, 3) as $category)
                                        <li><a href="{{ url('produk/kategori/'.$category['id']) }}">{{ $category['name'] }}</a></li>
                                    @endforeach
                                        <li><a href="{{ url('produk') }}">Lainnya</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ url('tentang') }}">Tentang</a></li>
                        <li><a href="{{ url('kontak') }}">Kontak</a></li>
                    </ul>
                </nav>
            </div>{{-- End .col-md-12 --}}
        </div>{{-- End .row --}}
    </div>{{-- End .container --}}
</div>{{-- End #nav --}}