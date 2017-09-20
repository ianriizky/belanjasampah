<div class="hot-items carousel-wrapper">
	<header class="content-title">
		<div class="title-bg">
			<h2 class="title">Produk hari ini</h2>
		</div>{{-- End .title-bg --}}
		<p class="title-desc">{{ !$goods_high->isEmpty() ? 'Rekomendasi dari kami untuk anda' : 'Maaf, barang kosong' }}</p>
	</header>
    @if (!$goods_high->isEmpty())
    <div class="carousel-controls">
        <div id="hot-items-slider-prev" class="carousel-btn carousel-btn-prev">
        </div>{{-- End .carousel-prev --}}
        <div id="hot-items-slider-next" class="carousel-btn carousel-btn-next carousel-space">
        </div>{{-- End .carousel-next --}}
    </div>{{-- End .carousel-controls --}}
    @endif
	<div class="hot-items-slider owl-carousel">
        @if (!$goods_high->isEmpty())
            @foreach ($goods_high as $good)
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
	</div>{{-- hot-items-slider  --}}
</div>{{-- End .hot-items --}}