@extends('layouts.venedor')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/prettyPhoto/prettyPhoto.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset('css/revslider.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/js/jquery.prettyPhoto.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.js"></script>
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
<div id="slider-rev-container">
    <div id="slider-rev">
        <ul>
            <li data-transition="fade" data-saveperformance="on"  data-title="Men Collection">
                <img src="img/homeslider/transparent.png" alt="background" style="background-color:#f1f6f7">
                <div class="tp-caption lfb ltb" data-x="100" data-y="50" data-speed="1200" data-start="600" data-easing="Expo.easeOut">
                    <a href="#"><img src="img/homeslider/slide2_1.png" alt="slide2_1" width="300" height="600"></a>
                </div>
                <div class="tp-caption rev-title skewfromleft stt" data-x="610" data-y="150" data-speed="800" data-start="900" 
                data-easing="Power3.easeIn" data-endspeed="300">New</div>
                 <div class="tp-caption rev-subtitle skewfromleft stt" data-x="610" data-y="205" data-speed="800" data-start="900" 
                 data-easing="Power3.easeIn" data-endspeed="300">Men Collection</div>
                <div class="tp-caption rev-text sfl stl" data-x="610" data-y="275" data-speed="800" data-start="1300" data-easing="Power3.easeIn"
                data-endspeed="300">Integer ultrices ipsum id justo ultrices sed blandit felis ultricies. Duis semper tristique congue. 
                Pellentesque id orcised ligula elementum tempor ut non nulla. Aenean lectus nulla, rutrum in tincidunt non, vestibulum a arcu...</div>
                
                <div class="tp-caption sfb stb" data-x="610" data-y="395" data-speed="1200" data-start="1800" data-easing="Power3.easeIn" data-endspeed="300">
                    <a href="#" class="btn btn-custom-2">Shop Now</a>
                </div>
            </li>
            
            <li data-transition="fade" data-saveperformance="on"  data-title="Sale">
                <img src="img/homeslider/transparent.png" alt="background" style="background-color:#f1f6f7">
                <div class="tp-caption rev-title skewfromleft stt" data-x="70" data-y="150" data-speed="800" data-start="900" 
                data-easing="Power3.easeIn" data-endspeed="300">Sale</div>
                 <div class="tp-caption rev-subtitle skewfromleft stt" data-x="70" data-y="205" data-speed="800" data-start="900" 
                 data-easing="Power3.easeIn" data-endspeed="300">It’s here & You’re invited</div>
                <div class="tp-caption rev-text sfl stl" data-x="70" data-y="275" data-speed="800" data-start="1300" data-easing="Power3.easeIn"
                data-endspeed="300">Nulla facilisi. Sed ultrices augue in neque aliquet eleifend volutpat augue viverra. Integer ante tellus, gravida ut vestibulum ut,
                varius idleo. Aliquam congue augue nec neque egestas bibendum. 
                Phasellus dapibus tellus quis metus...</div>
                
                <div class="tp-caption sfb stb" data-x="70" data-y="395" data-speed="1200" data-start="1800" data-easing="Power3.easeIn" data-endspeed="300">
                    <a href="#" class="btn btn-custom-2">Shop Now</a>
                </div>
                <div class="tp-caption lfb ltb" data-x="570" data-y="50" data-speed="1200" data-start="600" data-easing="Expo.easeOut">
                    <a href="#"><img src="img/homeslider/slide3_1.png" alt="slide3_1" width="560" height="600"></a>
                </div>
            </li>
            
            <li data-transition="fade" data-saveperformance="on"  data-title="LookBook">
                <img src="img/homeslider/transparent.png" alt="background" style="background-color:#f1f6f7">
                <div class="tp-caption lfb ltb" data-x="120" data-y="50" data-speed="1200" data-start="600" data-easing="Expo.easeOut">
                    <a href="#"><img src="img/homeslider/slide1_1.png" alt="slide1_1" width="330" height="600"></a>
                </div>
                <div class="tp-caption rev-title skewfromleft stt" data-x="610" data-y="150" data-speed="800" data-start="900" 
                data-easing="Power3.easeIn" data-endspeed="300">Lookbook</div>
                 <div class="tp-caption rev-subtitle skewfromleft stt" data-x="610" data-y="205" data-speed="800" data-start="900" 
                 data-easing="Power3.easeIn" data-endspeed="300">Spring-Summer-2012</div>
                <div class="tp-caption rev-text sfl stl" data-x="610" data-y="275" data-speed="800" data-start="1300" data-easing="Power3.easeIn"
                data-endspeed="300">Praesent arcu urna, cursus sit amet condimentum id, dapibusa mauris. Sed ante massa pellentesque luctus, magna sed ultricies 
                molestie, felis tortor pellentesque ligula, in sagittis neque turpis eget augue.</div>
                
                <div class="tp-caption sfb stb" data-x="610" data-y="395" data-speed="1200" data-start="1800" data-easing="Power3.easeIn" data-endspeed="300">
                    <a href="#" class="btn btn-custom-2">Shop Now</a>
                </div>
            </li>
            
        </ul>
    </div><!-- End #slider-rev -->
</div><!-- End #slider-rev-container -->

<div class="lg-margin"></div><!-- Space -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
			<div class="row">
				
				<div class="col-md-12 col-sm-12 col-xs-12 main-content">

                    <div class="lg-margin"></div><!-- space -->

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <header class="content-title">
                                <h2 class="title">Apa itu Belanja Sampah?</h2>
                            </header>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Belanja sampah adalah a fully responsive Magento theme with advanced admin module. Based on Bootstrap’s 12 column 1200px responsive grid Theme. Great looks on desktops, tablets and mobiles. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Venedor is extremely customizable, easy to use and fully responsive. Suitable for every type of store. Great as a starting point for your custom projects. This theme includes several extensions including ajax price slider that will help you improve your sales. We supply a full help with our products and after purchase support to all our customers. <a href="#">Buy Venedor Theme!</a></p>
                        </div><!-- End .col-md-6 -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="sm-margin visible-xs"></div><!-- space -->
                            <img src="img/showcase.png" alt="Showcase Venedor" class="img-responsive">
                        </div><!-- End .col-md-5 -->
                    </div><!-- End .row -->

                    <div class="xlg-margin"></div><!-- space -->
					
					<div class="hot-items carousel-wrapper">
						<header class="content-title">
							<div class="title-bg">
								<h2 class="title">Produk hari ini</h2>
							</div><!-- End .title-bg -->
							<p class="title-desc">Rekomendasi dari kami untuk anda</p>
						</header>

                    <div class="carousel-controls">
                        <div id="hot-items-slider-prev" class="carousel-btn carousel-btn-prev">
                        </div><!-- End .carousel-prev -->
                        <div id="hot-items-slider-next" class="carousel-btn carousel-btn-next carousel-space">
                        </div><!-- End .carousel-next -->
                    </div><!-- End .carousel-controls -->
					<div class="hot-items-slider owl-carousel">
                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item7.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item7-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$280</span>
                                </div><!-- End .item-price-container -->
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->
						<div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item2.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item2-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$160<span class="sub-price">.99</span></span>
                                </div><!-- End .item-price-container -->
                                <span class="new-rect">New</span>
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="80"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        5 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

						<div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item3.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item3-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$100</span>
                                </div><!-- End .item-price-container -->
                                <span class="new-rect">New</span>
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="99"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        4 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

						<div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item8.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item8-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="old-price">$100</span>
                                    <span class="item-price">$80</span>
                                </div><!-- End .item-price-container -->
                                <span class="discount-rect">-20%</span>
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="75"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        2 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

						<div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item5.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item5-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$99</span>
                                </div><!-- End .item-price-container -->
                                <span class="new-rect">New</span>
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="40"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        3 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item7.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item7-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$280</span>
                                </div><!-- End .item-price-container -->
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->
					</div><!--hot-items-slider -->

				</div><!-- End .hot-items -->

                <div class="xlg-margin"></div><!-- Space -->

                <div class="latest-items carousel-wrapper">
                        <header class="content-title">
                            <div class="title-bg">
                                <h2 class="title">Produk terbaru</h2>
                            </div><!-- End .title-bg -->
                            <p class="title-desc">Yang baru ditambahkan</p>
                        </header>

                    <div class="carousel-controls">
                        <div id="latest-items-slider-prev" class="carousel-btn carousel-btn-prev">
                        </div><!-- End .carousel-prev -->
                        <div id="latest-items-slider-next" class="carousel-btn carousel-btn-next carousel-space">
                        </div><!-- End .carousel-next -->
                    </div><!-- End .carousel-controls -->

                    <div class="latest-items-slider owl-carousel">
                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item4.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item4-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$120<span class="sub-price">.99</span></span>
                                </div><!-- End .item-price-container -->
                                <span class="new-rect">New</span>
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="80"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        4 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item1.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item1-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$60</span>
                                </div><!-- End .item-price-container -->
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="99"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        4 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item9.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item9-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="old-price">$108</span>
                                    <span class="item-price">$72</span>
                                </div><!-- End .item-price-container -->
                                <span class="discount-rect">-25%</span>
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="75"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        2 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item2.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item2-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$99</span>
                                </div><!-- End .item-price-container -->
                                <span class="new-rect">New</span>
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-result" data-result="40"></div>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-amount">
                                        3 Reviews
                                    </span>
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item7.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item7-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$280</span>
                                </div><!-- End .item-price-container -->
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->

                        <div class="item item-hover">
                            <div class="item-image-wrapper">
                                <figure class="item-image-container">
                                    <a href="product.html">
                                        <img src="img/products/item8.jpg" alt="item1" class="item-image">
                                        <img src="img/products/item8-hover.jpg" alt="item1  Hover" class="item-image-hover">
                                    </a>
                                </figure>
                                <div class="item-price-container">
                                    <span class="item-price">$280</span>
                                </div><!-- End .item-price-container -->
                            </div><!-- End .item-image-wrapper -->
                            <div class="item-meta-container">
                                <div class="ratings-container">
                                </div><!-- End .rating-container -->
                                <h3 class="item-name"><a href="product.html">Phasellus consequat</a></h3>
                                <div class="item-action">
                                    <a href="#" class="item-add-btn">
                                        <span class="icon-cart-text">Add to Cart</span>
                                    </a>
                                    <div class="item-action-inner">
                                        <a href="#" class="icon-button icon-like">Favourite</a>
                                        <a href="#" class="icon-button icon-compare">Checkout</a>
                                    </div><!-- End .item-action-inner -->
                                </div><!-- End .item-action -->
                            </div><!-- End .item-meta-container --> 
                        </div><!-- End .item -->
                    </div><!--latest-items-slider -->
                    </div><!-- End .latest-items -->

                </div><!-- End .col-md-12 -->
            </div><!-- End .row -->

                <div class="lg-margin"></div><!-- Space -->
			
			<div id="brand-slider-container" class="carousel-wrapper">
				<header class="content-title">
					<div class="title-bg">
						<h2 class="title">Koperasi kami</h2>
					</div><!-- End .title-bg -->
				</header>
                    <div class="carousel-controls">
                        <div id="brand-slider-prev" class="carousel-btn carousel-btn-prev">
                        </div><!-- End .carousel-prev -->
                        <div id="brand-slider-next" class="carousel-btn carousel-btn-next carousel-space">
                        </div><!-- End .carousel-next -->
                    </div><!-- End .carousel-controllers -->
                    <div class="sm-margin"></div><!-- space -->
                    <div class="row">
                        <div class="brand-slider owl-carousel">
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 1"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 2"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 3"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 4"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 5"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 6"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 7"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 8"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 9"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 10"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 11"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 12"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 13"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 14"></a>
                            <a href="#"><img src="img/brands/brand-logo.png" alt="Brand Logo 15"></a>
                        </div><!-- End .brand-slider -->
                    </div><!-- End .row -->
			</div><!-- End #brand-slider-container -->
			
		</div><!-- End .col-md-12 -->
	</div><!-- End .row -->
</div><!-- End .container -->
@endsection