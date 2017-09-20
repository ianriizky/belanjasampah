/* ================================================
----------- Venedor ---------- */
(function ($) {
	"use strict";
	var Venedor = {
		initialised: false,
		version: 1.4,
		mobile: false,
		menuCollapse: false,
		isFirefox: (navigator.userAgent.toLowerCase().indexOf('firefox') > -1),
		navContainerHeight: null,
		container : $('.portfolio-item-container'),
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			// Call Venedor Functions
			this.checkMobile();
			this.checkPlaceholder();
			this.getNavContainerHeight();
			this.menuHover();
			this.responsiveMenu();
			this.itemHoverAnimation();
			this.searchInput();
			this.itemSizeFix();
			this.filterColorBg();
			this.productZoomImage();
			this.responsiveVideo();
			this.priceSlider();
			this.ratings();
			this.collapseArrows();
			this.owlCarousels();
			this.flexsliders();
			this.scrollTopAnimation();
			this.filterScrollBar();
			this.selectBox();
			this.bootstrapSwitch();
			this.tooltip();
			this.popover();
			this.progressBars();
			this.prettyPhoto();
			this.flickerFeed();
			this.parallax();
			this.twitterFeed();

			/* Portfolio */
			var self = this;
			if (typeof imagesLoaded === 'function') {
				imagesLoaded(self.container, function() {
					self.calculateWidth();
					self.isotopeActivate();
					// recall for plugin support
					self.isotopeFilter();
				});
				
			}

		},
		checkMobile: function () {
			/* Mobile Detect*/
			if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				this.mobile = true;
			} else {
				this.mobile = false;
			}
		},
		checkPlaceholder: function () {
			/* Check for placeholder support */
			$.support.placeholder = (function(){
				var i = document.createElement('input');
				return 'placeholder' in i;
			})();

			// if Placeholder is not supported call plugin
			if (!$.support.placeholder && $.fn.placeholder) {
				$('input, textarea').placeholder();
			}
		},
		firefoxMenuFix: function () {
			/* This is fixed with the latest update 24 July 2014 -- Canceled the function invoke */
			/* This is important please do not delete if you don't know what you are doing */
			/* This is fix for header6 header7 version submenu align for firefox */
			/* Firefox has a bug for table layout - position relative */
			/* So submenus doesnt align properly */
			var winWidth = $(window).width(),
				header = $('#header'),
				isHeaderRight = header.hasClass('header6') || header.hasClass('header7'),
				menu = $('.menu');

				if (isHeaderRight && this.isFirefox) {
					var listElements = menu.children('li');
					listElements.each(function () {
						var $this = $(this),
							childUl = $this.children('ul'),
							leftPos = $this.position().left;

						if(childUl.length) {
							childUl.css('left', leftPos);
						}else {
							return;
						}
					});
				 }else {
					return;
				}
		},
		getNavContainerHeight: function () {
			/* Get nav container Height for better fixed menu */
			if($(window).width() > 768) {
				this.navContainerHeight = $('#main-nav-container').outerHeight();
			}
			
		},
		fixNavContainerHeight: function () {
			if($(window).width() <= 768 && $('.fixed-wrapper').length) {
				$('.fixed-wrapper').css('height', 'auto');
			}
		},
		stickyMenu: function () {
			var self = this,
				windowTop = $(window).scrollTop(),
	        	windowWidth = $(window).width(),
	            header = $('#header'),
	            navContainer = $('#main-nav-container'),
	            navContainerHeight = navContainer.height(),
	            navDist = navContainer.offset().top,
	            headerHeight = (header.height() - self.navContainerHeight);
	           	
	        if (windowTop >= navDist && windowTop > headerHeight && windowWidth > 768) {
	        	/* For better fixed nav i wrap navContainer with new element and give it same height */
	        	if(!navContainer.closest('.fixed-wrapper').length) {
	        		navContainer.wrap(function() {
	        			return '<div class="fixed-wrapper" style="height:'+ self.navContainerHeight +'px"></div>';
	        		});
	        	}
	            navContainer.addClass('fixed');
	        } else {
	        	navContainer.removeClass('fixed');
	        }
		},
		menuHover: function () {
			// Sub menu show/hide with hoverIntent plugin
			if ($.fn.hoverIntent) {
				$('ul.menu').hoverIntent({
					over: function() {
					if ($(window).width() > 768) {
						$(this).addClass('active').children('ul, .mega-menu').fadeIn(200);
					} else {
						return
					}

					},
					out: function() {
						if ($(window).width() > 768) {
							$(this).removeClass('active').children('ul, .mega-menu').fadeOut(75);
						} else {
							return
						}
					},
					selector: 'li',
					timeout: 145,
					interval: 55
				});
			}
		},
		responsiveMenu: function () {
			/* Create Responsive Menu */
			var menu = $('.menu').clone(true).removeClass('menu').addClass('responsive-nav'),
				container = $('#responsive-nav');
					
			container.append(menu);
			
			
			container.find('li, .col-2, .col-3, .col-4, .col-5').each(function () {

				var $this = $(this);
				
				
				if ($this.hasClass('mega-menu-container')) {
					$this.removeClass('mega-menu-container');
				}

				
				$this.has('ul, .megamenu').prepend('<span class="menu-button"></span>');
				
			});
			

			$('span.menu-button').on('click', function () {
				var $this= $(this);
				
				if (! $this.hasClass('active')) {
					$(this)
					.addClass('active')
					.siblings('ul, .mega-menu')
					.slideDown('800');
				}else {
					$(this)
					.removeClass('active')
					.siblings('ul, .mega-menu')
					.slideUp('800');
				}
			});
					

			$('#responsive-nav-button').on('click', function () {
				var $this = $(this);
				
				if( $this.hasClass('active')) {
					$('#responsive-nav').find('.responsive-nav').slideUp(300, function () {
						$this.removeClass('active');
					});
				
				}else {
					$('#responsive-nav').find('.responsive-nav').slideDown(300, function () {
						$this.addClass('active');
					});
				}
			});
		},
		itemAnimationIn: function () {
			var $this = $(this),
				itemText = $this.find('.icon-cart-text'),
				itemWidth = $this.width(),
				ratingAmount = $this.find('.ratings-amount'),
				moreActionBtns = $this.find('.item-action-inner');


			if (itemWidth < 220) {
				itemText.animate({width: 'hide'},100, function() {
					$(this).closest('.item-add-btn').addClass('icon-cart');
				});
			}

			ratingAmount.animate({width : 'show'}, 300);
			moreActionBtns.css({'visibility': 'visible', 'overflow': 'hidden', 'padding-left': 10}).animate({width:85}, 300);
		},
		itemAnimationOut: function () {
			var $this = $(this),
				itemText = $this.find('.icon-cart-text'),
				itemWidth = $this.width(),
				ratingAmount = $this.find('.ratings-amount'),
				moreActionBtns = $this.find('.item-action-inner');


			if (itemWidth < 220) {
				// be careful about this duration
				// make sure that it is the same as below's
				itemText.animate({width: 'show'},300).closest('.item-add-btn').removeClass('icon-cart');
			}

			ratingAmount.animate({width : 'hide'}, 300);
			moreActionBtns.animate({width:0}, 300, function() {
				/* For better animation delete padding after animation's done*/
				$(this).css('padding-left', 0);
			}).css({'visibility': 'hidden', 'overflow': 'hidden'});
		},
		itemHoverAnimation: function () {
			var self = this;
			
			// Don't forget to use hoverIntent plugin for better ainmation!
			if ($.fn.hoverIntent) {
				$('.item-hover').hoverIntent(self.itemAnimationIn, self.itemAnimationOut);
			} else {
				$('.item-hover').on('mouseover', self.itemAnimationIn).on('mouseleave', self.itemAnimationOut);
			
			}
		},
		itemSizeFix: function () {
			/* Fix for item display type which has no hover animation*/
			var container = $('#content'),
				items = container.find('.item');

			items.each(function() {
				var $this = $(this);
				/* There is a conflict, item class name also used for bootstrap slider items */
				/* This is check to prevent it */
				if ($this.hasClass('item-hover') || $this.closest('.carousel-inner').length) {
					return;
				} else {
					if($this.width() < 220) {
						$this.find('.icon-cart-text').fadeOut(20, function() {
							$(this).closest('.item-add-btn').addClass('icon-cart');
						});
						$this.find('.ratings-container.pull-right, .item-price-container.pull-left').css({'float': 'none', 'display': 'block', 'width': '100%'});
						$this.find('.item-price-container.pull-left').css('margin-bottom', 10);
						$this.find('.item-action').css('text-align', 'center');
					} else {
						$this.find('.icon-cart-text').fadeIn(10).closest('.item-add-btn').removeClass('icon-cart');
						$this.find('.ratings-container.pull-right').css({'float': 'right', 'width': 'auto'});
						$this.find('.item-price-container.pull-left').css({'float': 'left', 'width': 'auto', 'margin-bottom': 0});
						$this.find('.item-action').css('text-align', 'left');
					}
				}
			});
			
		},
		searchInput: function () {
			/* Search bar input animation for Better Responsive
			----- if not empty send form  */
			var formInputOpen = true;
			$('#quick-search').on('click', function(e) {
				var $this = $(this),
					parentForm = $this.closest('.quick-search-form'),
					searchInput = parentForm.find('.form-control'),
					searchInputVal = $.trim(searchInput.val());
				
				if (searchInputVal === '') {
					var hiddenGroup = parentForm.find(':hidden.form-group'),
					formGroup = parentForm.find('.form-group ');

					if (formInputOpen) {
						hiddenGroup.animate({width:'show'}, 400, function() {
							formInputOpen = false;
						});
					} else {
						formGroup.animate({width:'hide'}, 400, function() {
							formInputOpen = true;
						});
					}

					e.preventDefault();
				}
				
			});
		},
		filterColorBg: function () {
			/* Category-item filter color box background */
			$('.filter-color-box').each(function() {
				var $this = $(this),
					bgColor = $this.data('bgcolor');

					$this.css('background-color', bgColor);
			});
		},
		twitterFeed: function () {
			/* Twitter Feeds */
			if ($.fn.tweet && $('.twitter_feed').length) {
		        $('.twitter_feed').tweet({
		            modpath: './js/twitter/',
		            avatar_size: '',
					count: 4,
					query: "themeforest", // write feed query here
					loading_text: "searching twitter...",
		            join_text: "",
		            template: "{join}{text}{time}"
		            /* etc... */
		        });
		        
		        $('.twitter_feed.flexslider').flexslider({
					animation: "slide",
					selector: ".tweet_list > li",
					controlNav: false,// false
					prevText: '',
					nextText: '',
					animationLoop: true,
					smoothHeight: true,
					slideshowSpeed: 5000
				});
		    }

		    if ($.fn.tweet && $('.twitter_feed_widget').length) {

		        $('.twitter_feed_widget').tweet({
		            modpath: './js/twitter/',
		            avatar_size: '',
					count: 2,
					query: "themeforest", // write feed query here
					loading_text: "searching twitter...",
		            join_text: "",
		            template: "{join}{text}{time}"
		            /* etc... */
		        });

		    }
		},
		productZoomImage: function () {
			var self = this,
				carouselContainer = $('#product-carousel'),
                productImg =  $('#product-image');

            if($.fn.elastislide) {
				carouselContainer.elastislide({
					orientation : 'vertical',
					minItems : 4
				});
			}

			// Product page zoom plugin settings
			if ($.fn.elevateZoom) {
				$('#product-image').elevateZoom({
					responsive: true, // simple solution for zoom plugin down here // it can cause bugs at resize
					zoomType: ( self.mobile || $(window).width() < 768 ) ? 'inner' : 'lens', // you can use 'inner' or 'window' // change inner and go to product.html page and see zoom plugin differances
					borderColour: '#d0d0d0',
					cursor: "crosshair",
					borderSize: 2,
					lensSize : 180,
					lensOpacity: 1,
					lensColour: 'rgba(255, 255, 255, 0.25)'
				});

				$('#product-carousel').find('a').on('mouseover', function (e) {
					var ez = $('#product-image').data('elevateZoom'),
						smallImg = $(this).data('image'),
						bigImg = $(this).data('zoom-image');

						ez.swaptheimage(smallImg, bigImg);
					e.preventDefault();
				});
			}
		},
		responsiveVideo: function () {
			/* Check for fitVids plugin 
			-- And activate it for all videos under the body tag */
			if ($.fn.fitVids) {
				$('body').fitVids();
			}
		},
		priceSlider: function () {
			/* Price Filter Slider / Category pages */
			if ($.fn.noUiSlider) {
				$('#price-range').noUiSlider({
					range: [0, 999],
					start: [0, 999],
					handles: 2,
					connect: true,
					step: 1,
					serialization: {
						to: [ $('#price-range-low'), $('#price-range-high') ],
						resolution: 1
					}
				});
			}
		},
		ratings : function () {
			/* Calculate Ratings % and set width */
			$.each($('.ratings-result'), function () {
				var $this = $(this),
					parentWidth = $this.closest('.ratings').width(),
					rating = $(this).data('result'),
					newWidth = (parentWidth / 100) * rating;
					
				$(this).css('width', newWidth);
			});
		},
		collapseArrows : function () {
			// Blog Sidebar Widget Collapse with plugin's custom events
			$('.panel-title').on('click', function () {
				var $this = $(this),
					targetAcc = $this.find('a').attr('href');
				
				$(targetAcc).on('shown.bs.collapse', function() {
					$this.find('.icon-box').html('&plus;');
				}).on('hidden.bs.collapse', function() {
					$this.find('.icon-box').html('&minus;');
				});
			});
			
			
			// Checkout Collapse//Accordion
			$('.accordion-btn').on('click', function() {
				var $this = $(this),
					targetAcc = $this.data('target');
				
				$(targetAcc).on('shown.bs.collapse', function() {
					$this.addClass('opened');
				}).on('hidden.bs.collapse', function() {
					if ($this.hasClass('opened')) {
						$this.removeClass('opened');
					}
					
				});
				
			});
		},
		checkSupport: function(elemname, pluginname) {
			/* Simple check element and plugin */
			return (elemname.length && pluginname) ? true : false;
		},
		owlCarousels: function () {
			var self = this;

			/*  Brand Slider */			
			var  brandSlider = $('div.brand-slider.owl-carousel');
			if (self.checkSupport(brandSlider, $.fn.owlCarousel)) {
		        brandSlider.owlCarousel({
		            items: 6,
		            itemsDesktop : [1199,5],
		            itemsDesktopSmall: [979,4],
		            itemsTablet: [768,2],
		            itemsMobile : [479,1],
		            slideSpeed: 600,
		            autoPlay: 10000,
		            stopOnHover: true,
		            navigation: false,
		            pagination: false,
		            responsive: true,
		            autoHeight : true
		        }).data('navigationBtns', ['#brand-slider-prev', '#brand-slider-next']);
		    }
				

			/* Home Page Onsale - hot-items carousel */
			var  hotItems = $('.hot-items-slider.owl-carousel');
			if (self.checkSupport(hotItems, $.fn.owlCarousel)) {
		        hotItems.owlCarousel({
		            items: 4,
		            itemsDesktop : [1199,4],
		            itemsDesktopSmall: [979,3],
		            itemsTablet: [768,2],
		            itemsMobile : [479,1],
		            slideSpeed: 400,
		            autoPlay: 8000,
		            stopOnHover: true,
		            navigation: false,
		            pagination: false,
		            responsive: true,
		            mouseDrag: false,
		            autoHeight : true
		        }).data('navigationBtns', ['#hot-items-slider-prev', '#hot-items-slider-next']);
		    }


		    /* Home Page Onsale - latest-items carousel */
			var  latestItems = $('.latest-items-slider.owl-carousel');
			if (self.checkSupport(latestItems, $.fn.owlCarousel)) {
		        latestItems.owlCarousel({
		            items: 4,
		            itemsDesktop : [1199,4],
		            itemsDesktopSmall: [979,3],
		            itemsTablet: [768,2],
		            itemsMobile : [479,1],
		            slideSpeed: 400,
		            autoPlay: 8000,
		            stopOnHover: true,
		            navigation: false,
		            pagination: false,
		            responsive: true,
		            mouseDrag: false,
		            autoHeight : true
		        }).data('navigationBtns', ['#latest-items-slider-prev', '#latest-items-slider-next']);
		    }


			/* Also purchased slider - product.html */
			var  purchasedItems = $('.purchased-items-slider.owl-carousel');
			if (self.checkSupport(purchasedItems, $.fn.owlCarousel)) {
		        purchasedItems.owlCarousel({
		            items: 4,
		            itemsDesktop : [1199,4],
		            itemsDesktopSmall: [979,3],
		            itemsTablet: [768,2],
		            itemsMobile : [479,1],
		            slideSpeed: 400,
		            autoPlay: 8000,
		            stopOnHover: true,
		            navigation: false,
		            pagination: false,
		            responsive: true,
		            mouseDrag: false,
		            autoHeight : true
		        }).data('navigationBtns', ['#purchased-items-slider-prev', '#purchased-items-slider-next']);
		    }


			/* Similiar Items slider - cart.html */
			var  similiarItems = $('.similiar-items-slider.owl-carousel');
			if (self.checkSupport(similiarItems, $.fn.owlCarousel)) {
		        similiarItems.owlCarousel({
		            items: 4,
		            itemsDesktop : [1199,4],
		            itemsDesktopSmall: [979,3],
		            itemsTablet: [768,2],
		            itemsMobile : [479,1],
		            slideSpeed: 400,
		            autoPlay: 8000,
		            stopOnHover: true,
		            navigation: false,
		            pagination: false,
		            responsive: true,
		            mouseDrag: false,
		            autoHeight : true
		        }).data('navigationBtns', ['#similiar-items-slider-prev', '#similiar-items-slider-next']);
		    }


			/* Related portfolio - single-portfolio.html */
			var  relatedPortfolio = $('.related-portfolio.owl-carousel');
			if (self.checkSupport(relatedPortfolio, $.fn.owlCarousel)) {
		        relatedPortfolio.owlCarousel({
		            items: 4,
		            itemsDesktop : [1199,4],
		            itemsDesktopSmall: [979,3],
		            itemsTablet: [768,2],
		            itemsMobile : [479,1],
		            slideSpeed: 400,
		            autoPlay: 8000,
		            stopOnHover: true,
		            navigation: false,
		            pagination: false,
		            responsive: true,
		            mouseDrag: false,
		            autoHeight : true
		        }).data('navigationBtns', ['#related-slider-prev', '#related-slider-next']);
		    }


			/* Register OwlCarousel custom navigation buttons */
			/* This add to our id's which we added via data('navigationBtns'), plugin api for navigation*/
		    if (self.checkSupport($('.owl-carousel'), $.fn.owlCarousel)) {
			    $('.owl-carousel').each(function() {
			    	var $this = $(this),
			    		owlCarousel = $this.data('owlCarousel'),
			    		owlBtns = $this.data('navigationBtns'),
			    		prevBtn, nextBtn;

		    		if (typeof owlCarousel === 'undefined' || typeof owlBtns === 'undefined') {
		    			return;
		    		}

		    		for(var key in owlBtns) {
		    			if (owlBtns[key].indexOf('next') == -1) {
		    				prevBtn = $(owlBtns[key]);
		    			}else {
		    				nextBtn = $(owlBtns[key]);
		    			}
		    		}

		    		prevBtn.on('click touchstart', function(e) {
			            owlCarousel.prev();
			            e.preventDefault();
		    		});

		    		nextBtn.on('click touchstart', function(e) {
			            owlCarousel.next();
			            e.preventDefault();
		    		});
		        });
			}

		},
		flexsliders: function () {

			if ($.fn.flexslider) {

				/* Category Banner Slider */
				$('.category-image-slider.flexslider').flexslider({
					animation: "slide",
					animationLoop: true,
					prevText: '',
					nextText: '',
					controlNav: false,
					smoothHeight: true,
					slideshowSpeed: 6500
				});	


				/* Sidebar Latest Posts Slider */
				$('.latest-posts-slider.flexslider').flexslider({
					animation: "slide",
					selector: ".latest-posts-list > li",
					prevText: '',
					nextText: '',
					controlNav: false, // false
					smoothHeight: true,
					slideshowSpeed: 6000
				});

					
				/* Sidebar Latest Posts Slider */
				$('.recent-posts-slider.flexslider').flexslider({
					animation: "slide",
					selector: ".recent-posts-list > li",
					prevText: '',
					nextText: '',
					controlNav: false,// false
					smoothHeight: true,
					slideshowSpeed: 5500
				});


				/* Sidebar Testimonials Slider */
				$('.testimonials-slider.flexslider').flexslider({
					animation: "fade",
					selector: ".testimonials-list > li",
					prevText: '',
					nextText: '',
					controlNav: false, // false
					slideshowSpeed: 4800
				});


				/* Sidebar Featured Product Slider */
				$('.featured-slider.flexslider').flexslider({
					animation: "slide",
					selector: ".featured-list > li",
					controlNav: false,// false
					prevText: '',
					nextText: '',
					smoothHeight: true,
					slideshowSpeed: 7000
				});
					

				/* Sidebar Related Product Slider */
				$('.related-slider.flexslider').flexslider({
					animation: "slide",
					selector: ".related-list > li",
					controlNav: false,// false
					prevText: '',
					nextText: '',
					smoothHeight: true,
					slideshowSpeed: 7000
				});
						

				/* Sidebar Banner Slider */
				$('.banner-slider.flexslider').flexslider({
					animation: "fade",
					selector: ".banner-slider-list > li",
					directionNav: false, // false next/prev
					controlNav: true,
					prevText: '',
					nextText: '',
					slideshowSpeed: 6500
				});


				/* Testimonials Slider -  About Us Page */
				$('.about-us-testimonials.flexslider').flexslider({
					animation: "slide",
					controlNav: true,// false
					directionNav: false,
					animationLoop: true,
					smoothHeight: true,
					slideshowSpeed: 6000
				});


				/* Single Portfolio Gallery slider */
				$('.single-portfolio-slider.flexslider').flexslider({
					animation: "slide",
					controlNav: false,// false
					directionNav: true,
					animationLoop: true,
					smoothHeight: true,
					slideshowSpeed: 6000
				});


				/* Footer Popular Slidar */
				$('.footer-popular-slider.flexslider').flexslider({
					animation: "slide",
					controlNav: false,// false
					prevText: '',
					nextText: '',
					smoothHeight: true,
					slideshowSpeed: 8000
				});


				/* Footer Featured Slidar */
				$('.footer-featured-slider.flexslider').flexslider({
					animation: "slide",
					controlNav: false,// false
					prevText: '',
					nextText: '',
					smoothHeight: true,
					slideshowSpeed: 10000
				});


				/* Footer Special Slidar */
				$('.footer-specials-slider.flexslider').flexslider({
					animation: "slide",
					controlNav: false,// false
					prevText: '',
					nextText: '',
					smoothHeight: true,
					slideshowSpeed: 9000
				});
			}

		},
		scrollTopBtnAppear: function () {
			// This will be triggered at the bottom of code with window scroll event
			var windowTop = $(window).scrollTop(),
		            scrollTop = $('#scroll-top');

	        if (windowTop >= 300) {
	            scrollTop.addClass('fixed');
	        } else {
	            scrollTop.removeClass('fixed');
	        }
		    
		},
		scrollTopAnimation: function () {
			$('#scroll-top').on('click', function (e) {
		        $('html, body').animate({
		            'scrollTop': 0
		        }, 1200);
		        e.preventDefault();
		    });
		},
		filterScrollBar: function () {
			/* Category filter sidebar custom scrollbar with jscrollpane plugin */
			var catFilter = $('.category-filter-list.jscrollpane'),
				checkForScrollbar = function(a) {
					var catHeight = a.height();
					if ( catHeight > 300 ) {
						a.css('height', 300);
						a.jScrollPane({
							showArrows: false
						});
					}
				};
				
			// on document ready call plugin if section height > 300	
			$.each(catFilter, function () {
				var $this = $(this);
				checkForScrollbar($this);
				
			});
				
			// Call plugin after collapse activated
			$('#category-filter').find('.collapse').on('shown.bs.collapse', function() {
				var cFilter = $(this).find('.category-filter-list.jscrollpane');
				checkForScrollbar(cFilter);
			});
				
		},
		fixfilterScrollBar: function() {
			// on window resize fix scroll bar position
			$('.category-filter-list.jscrollpane').each(function () {
				var apiJsc = $(this).data('jsp'),
				resTime;
				
				if (!resTime) {
					resTime = setTimeout(function(){
						if (apiJsc) {
							apiJsc.reinitialise();
						}
						resTime = null;
					},50);
				}
			});
		},
		selectBox: function () {
			// Custom select box via selectbox plugin
			// Be sure to include jquery.selectbox.min.js file
			if ($.fn.selectbox) {
				$('.selectbox').selectbox({
					effect: "fade",
					onChange: function (value, inst) {
						
					}
				});
			}
			
		},
		bootstrapSwitch: function () {
			//Bootstrap switch
			if ($.fn.bootstrapSwitch) {
				$('.switch').bootstrapSwitch();
			}
		},
		tooltip: function () {
			// Bootstrap tooltip
			if($.fn.tooltip) {
				$('.add-tooltip').tooltip();
			}
		},
		popover: function () {
			// Bootstrap tooltip
			if($.fn.popover) {
				$('.add-popover').popover({
					trigger: 'focus'
				});
			}
		},
		progressBars: function () {
			/* Calculate and Animate Progress */
			if ($.fn.appear) {
				$('.progress-animate').appear();
				$('.progress-animate').on('appear', function () {
					var $this = $(this),
						progressVal = $(this).data('width'),
						progressText = $this.find('.progress-text');

					$this.css({ 'width' : progressVal + '%'}, 400);
					progressText.fadeIn(500);
				});

			} else {

				$('.progress-animate').each(function () {
					var $this = $(this),
						progressVal = $(this).data('width'),
						progressText = $this.find('.progress-text');

					$this.css({ 'width' : progressVal + '%'}, 400);
					progressText.fadeIn(500);
				});
			}
		},
		scrollAnimations: function () {

			/* 	// Wowy Plugin
				Add Html elements wow and animation class 
				And you can add duration via data attributes
				data-wow-duration: Change the animation duration
				data-wow-delay: Delay before the animation starts
				data-wow-offset: Distance to start the animation (related to the browser bottom)
				data-wow-iteration: Number of times the animation is repeated
			*/

			// Check for class WOW // You need to call wow.min.js and animate.css for scroll animations to work
			if (typeof WOW === 'function') {
				new WOW({
					boxClass:     'wow',      // default
					animateClass: 'animated', // default
					offset:       0          // default
				}).init();
			}

		},
		prettyPhoto: function() {
			/* Portfolio prettPhoto Plugin */
			if ($.fn.prettyPhoto) {

				$("a[data-rel^='prettyPhoto']").prettyPhoto({
					hook: 'data-rel',
		            animation_speed: 'fast',
		            slideshow: 6000,
		            autoplay_slideshow: true,
		            show_title: false,
		            deeplinking: false,
		            social_tools: '',
		            overlay_gallery: true,
					theme: 'light_square'
				});
			}

		},
		tabMenuHeight: function (limitHeight) {
			var container = $('.tab-container.left, .tab-container.right'),
				newHeight = container.find('.tab-pane.active').outerHeight(),
				navContainer = container.find('.nav-tabs');

			if (newHeight > limitHeight) {
				navContainer.css('height', newHeight);
				navContainer.find('li:last-child').find('a').css('border-bottom-color', '#dcdcdc');
			} else {
				navContainer.css('height', limitHeight);
				navContainer.find('li:last-child').find('a').css('border-bottom-color', 'transparent');
			}
		},
		flickerFeed: function () {
			/* Flickr feed plugin - Sidebar */
			if ($.fn.jflickrfeed) {
				$('ul.flickr-feed-list').jflickrfeed({
					limit: 6,
					qstrings: {
						id: '52617155@N08'
					},
					itemTemplate: '<li>' + '<a data-rel="prettyPhoto[gallery-flickr]" href="{{image}}" title="{{title}}">' + '<img src="{{image_s}}" alt="{{title}}" />' + '</a>' + '</li>'
				}, function() {
					if ($.fn.prettyPhoto) {
						/* update prettyphoto plugin for feeds */
						$("a[data-rel^='prettyPhoto']").prettyPhoto({
							hook: 'data-rel',
			                animation_speed: 'fast',
			                slideshow: 6000,
			                autoplay_slideshow: true,
			                show_title: false,
			                deeplinking: false,
			                social_tools: '',
			                overlay_gallery: true,
							theme: 'light_square'
						});
					}
				});
				
			}
		},
		parallax: function () {
			/* Parallax - if not mobile */
			if (!Venedor.mobile && $.fn.parallax) {
				$('#page-header').addClass('parallax').parallax("50%", 0.4);
				$('#testimonials-section').addClass('parallax').parallax("50%", 0.4);
			}
		},// Portfolio pages isotope
		calculateWidth: function () {
			// Calculate portfolio items width for better responsive items
			var widthPort = $(window).width(),
                    contWidth = this.container.width(),
                    maxColumn = this.container.data('maxcolumn'),
                    itemW;

            if (widthPort > 1170) {
            	itemW = (maxColumn) ? maxColumn: 5;
            } else if (widthPort > 960) {
                itemW = (maxColumn) ? maxColumn: 4;
            } else if (widthPort > 768) {
                itemW = 3;
            } else if (widthPort > 540) {
                itemW = 2;
            } else {
                itemW = 1;
            }

            var targetItems = this.container.find('.portfolio-item');
            if (itemW >= 4 && targetItems.hasClass('wide')) {
            	this.container.find('.wide').css('width', (Math.floor(contWidth / itemW) * 2 ));
        		targetItems.not('.wide').css('width', Math.floor(contWidth / itemW ));
            } else {
            	targetItems.css('width', Math.floor(contWidth / itemW));
            }
			
		},
		isotopeActivate: function() {
			// Trigger for isotop plugin
				if($.fn.isotope) {
					var container = this.container,
						layoutMode = container.data('layoutmode');

					var iso = container.isotope({
	                	itemSelector: '.portfolio-item',
	                	layoutMode: (layoutMode) ? layoutMode : 'masonry'
	            	}).data('isotope');
				}
				// checked layout mode via instance
				// console.log(iso);
		},
		isotopeReinit: function () {
			// Recall for isotope plugin
			if($.fn.isotope) {
				this.container.isotope('destroy');
				this.isotopeActivate();
			}
		},
		isotopeFilter: function () {
			// Isotope plugin filter handle
			var self = this,
				filterContainer = $('#portfolio-filter');
			filterContainer.find('a').on('click', function(e) {
				var $this = $(this),
					selector = $this.attr('data-filter');

				filterContainer.find('.active').removeClass('active');

				// And filter now
				self.container.isotope({
					filter: selector 
				});
				
				$this.addClass('active');

				e.preventDefault();
			});
		}

	};

	Venedor.init();

	// Load Event
	$(window).on('load', function() {
		/* Trigger Scroll Animations */
		Venedor.scrollAnimations();
	});

	// Scroll Event
	$(window).on('scroll', function () {
		/* Display Scrol to Top Button */
		Venedor.scrollTopBtnAppear();

		/* Sticky Navigation Menu */
		Venedor.stickyMenu();
	});

	// Resize Event 
	// Smart resize if plugin not found window resize event
	if($.event.special.debouncedresize) {
		$(window).on('debouncedresize', function() {
	       /* Fix category sidebar filter scrollbars */
			Venedor.fixfilterScrollBar();
			/* Sticky Navigation Menu */
			Venedor.stickyMenu();
			/* Fix navcontainer on resize */
			Venedor.fixNavContainerHeight();

			/* Portfolio items / isotope retrigger */
			Venedor.calculateWidth();
			Venedor.isotopeReinit();

			/* Fix Firefox for submenu of header6 and header7 varients*/
			Venedor.firefoxMenuFix();

			/* Size fix for product/item */
			Venedor.itemSizeFix();
	    });
	} else {
		$(window).on('resize', function () {
			/* Fix category sidebar filter scrollbars */
			Venedor.fixfilterScrollBar();
			/* Sticky Navigation Menu */
			Venedor.stickyMenu();
			/* Fix navcontainer on resize */
			Venedor.fixNavContainerHeight();

			/* Portfolio items / isotope retrigger */
			Venedor.calculateWidth();
			Venedor.isotopeReinit();

			/* Fix Firefox for submenu of header6 and header7 varients*/
			Venedor.firefoxMenuFix(); 

			/* Size fix for product/item */
			Venedor.itemSizeFix();
		});
	}

	$(window).on('resize load', function() {
		var winWidth = $(window).width(),
			tabContainer = $('.tab-container.left, .tab-container.right'),
			limitHeight = tabContainer.find('ul.nav-tabs').outerHeight();
		
		if ( winWidth > 767) {
			Venedor.tabMenuHeight(limitHeight);

			$('.tab-container').find('ul.nav-tabs').find('a').on('shown.bs.tab', function (e) {
				Venedor.tabMenuHeight(limitHeight);
			});
		}
		
	});


})(jQuery);


/*----------------------------------------------------*/
//* Google javascript api v3  -- map */
/*----------------------------------------------------*/
(function () {
    "use strict";

    function initialize() {
        /* change your with your coordinates */
        var myLatLng = new google.maps.LatLng(51.520068, -0.156299), // Your coordinates
            mappy = {
                center: myLatLng,
                zoom: 15,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{
                    "elementType": "geometry",
                    "stylers": [{
                        "hue": "#000"
                    }, {
                        "weight": 1
                    }, {
                        "saturation": -200
                    }, {
                        "gamma": 0.70
                    }, {
                        "visibility": "on"
                    }]
                }]
            };
        var map = new google.maps.Map(document.getElementById("map"), mappy),
        	newpin = 'img/pin.png';

        new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: newpin,
            animation: google.maps.Animation.DROP,
            title: 'Venedor' // Title for marker
        });
    }

    if (document.getElementById("map")) {
        google.maps.event.addDomListener(window, 'load', initialize);
    }

}());