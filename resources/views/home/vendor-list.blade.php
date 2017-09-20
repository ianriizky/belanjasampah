<div id="brand-slider-container" class="carousel-wrapper">
	<header class="content-title">
		<div class="title-bg">
			<h2 class="title">Koperasi dan bank sampah yang bergabung</h2>
		</div>{{-- End .title-bg --}}
	</header>
    @if (!$koperasis->isEmpty() && !$banks->isEmpty())
    <div class="carousel-controls">
        <div id="hot-items-slider-prev" class="carousel-btn carousel-btn-prev">
        </div>{{-- End .carousel-prev --}}
        <div id="hot-items-slider-next" class="carousel-btn carousel-btn-next carousel-space">
        </div>{{-- End .carousel-next --}}
    </div>{{-- End .carousel-controls --}}
    @endif
    <div class="sm-margin"></div>{{-- space --}}
    <div class="row">
        <div class="brand-slider owl-carousel">
            @if (!$koperasis->isEmpty() && !$banks->isEmpty())
                @foreach ($koperasis as $koperasi)
                    <a href="#"><img src="{{ $koperasi->picture }}" title="{{ $koperasi->name }}"></a>
                @endforeach
                @foreach ($banks as $bank)
                    <a href="#"><img src="{{ $bank->picture }}" title="{{ $bank->name }}"></a>
                @endforeach
            @else
                <p>Maaf, koperasi dan bank kosong.</p>
            @endif
        </div>{{-- End .brand-slider --}}
    </div>{{-- End .row --}}
</div>{{-- End #brand-slider-container --}}