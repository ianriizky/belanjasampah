<div class="latest-items carousel-wrapper">
    <header class="content-title">
        <div class="title-bg">
            <h2 class="title">Produk terbaru</h2>
        </div>{{-- End .title-bg --}}
        <p class="title-desc">{{ !$goods_standard->isEmpty() ? 'Yang baru ditambahkan' : 'Maaf, barang kosong' }}</p>
    </header>
    @if (!$goods_standard->isEmpty())
    <div class="carousel-controls">
        <div id="hot-items-slider-prev" class="carousel-btn carousel-btn-prev">
        </div>{{-- End .carousel-prev --}}
        <div id="hot-items-slider-next" class="carousel-btn carousel-btn-next carousel-space">
        </div>{{-- End .carousel-next --}}
    </div>{{-- End .carousel-controls --}}
    @endif
    <div class="latest-items-slider owl-carousel">
        @if (!$goods_standard->isEmpty())
            @foreach ($goods_standard as $good)
                <div class="item item-hover">
                    <div class="item-image-wrapper">
                        <figure class="item-image-container">
                            <a href="{{ url('produk/'.$good->id) }}">
                                <img src="{{ $good->picture }}" class="item-image">
                                <img src="{{ $good->picture }}" class="item-image-hover">
                            </a>
                        </figure>
                        <div class="item-price-container">
                            <span class="item-price">Rp{{ $good->price }}</span>
                        </div>{{-- End .item-price-container --}}
                        <span class="new-rect">Baru</span>
                    </div>{{-- End .item-image-wrapper --}}
                    <div class="item-meta-container">
                        <h3 class="item-name"><a href="{{ url('produk/'.$good->id) }}">{{ $good->name }}</a></h3>
                        <div class="item-action">
                            <a href="{{ url('produk/'.$good->id) }}" class="item-add-btn">
                                <span class="icon-cart-text">Lihat Detail</span>
                            </a>
                            {{-- <div class="item-action-inner">
                                <a href="#" class="icon-button icon-compare">Checkout</a>
                            </div> --}}{{-- End .item-action-inner --}}
                        </div>{{-- End .item-action --}}
                    </div>{{-- End .item-meta-container  --}}
                </div>{{-- End .item --}}
            @endforeach
        @endif
    </div>{{-- latest-items-slider  --}}
</div>{{-- End .latest-items --}}