@extends('layouts.venedor')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/prettyPhoto/prettyPhoto.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.carousel.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.css"> --}}
<link rel="stylesheet" href="{{ asset('css/revslider.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/js/jquery.prettyPhoto.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.js"></script> --}}
<script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-themepunch.revolution/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-themepunch.revolution/jquery.themepunch.revolution.min.js') }}"></script>
<script>
    $('#flash-overlay-modal').modal();
</script>
<script>
    $(function() {
        // Slider Revolution
        jQuery('#slider-rev').revolution({
            delay:5000,
            startwidth:1170,
            startheight:600,
            onHoverStop:"true",
            hideThumbs:250,
            navigationHAlign:"center",
            navigationVAlign:"bottom",
            navigationHOffset:0,
            navigationVOffset:20,
            soloArrowLeftHalign:"left",
            soloArrowLeftValign:"center",
            soloArrowLeftHOffset:0,
            soloArrowLeftVOffset:0,
            soloArrowRightHalign:"right",
            soloArrowRightValign:"center",
            soloArrowRightHOffset:0,
            soloArrowRightVOffset:0,
            touchenabled:"on",
            stopAtSlide:-1,
            stopAfterLoops:-1,
            dottedOverlay:"none",
            fullWidth:"on",
            spinned:"spinner2",
            shadow:0,
            hideTimerBar: "on",
            // navigationStyle:"preview3"
          });    
    });
</script>
@endpush

@push('breadcrumbs')

@endpush

@section('main-content')
@include('flash::message')
@include('home.slider')
<div class="lg-margin"></div>{{-- Space --}}
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 main-content">
                    <div class="xlg-margin"></div>{{-- space --}}
					@include('home.hot-items')
                    <div class="xlg-margin"></div>{{-- Space --}}
                    @include('home.latest-items')
                </div>{{-- End .col-md-12 --}}
            </div>{{-- End .row --}}
            <div class="lg-margin"></div>{{-- Space --}}
			@include('home.vendor-list')
		</div>{{-- End .col-md-12 --}}
	</div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection