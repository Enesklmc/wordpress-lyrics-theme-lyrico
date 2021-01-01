( function ( $ ) {

	var $body = $( 'body' );

	var $navigation = $body.find( '#site-navigation' );

	var lastScrollTop = 0;
	var delta = 5;
	var didScroll;
	var totalSliderNavbarWidth = 0;

	$( document ).ready( function () {
		revealPosts();

		$('.swiper-navbar-slider .nav-item').each(function() {
		    var $this = $(this);
		    var width = $this.outerWidth();
			totalSliderNavbarWidth += width;
		});

		if( $('.swiper-navbar-slider').outerWidth() <  totalSliderNavbarWidth ){
			$('.swiper-navbar-slider').addClass('bordered-menu');
		}

		if ( $( '#artist-albums-and-lyrics' ).length ) {
			$( '#artist-albums-and-lyrics #heading-1' ).attr( "aria-expanded", "true" );
			$( '#artist-albums-and-lyrics #collapse-1' ).addClass( "show" );
		}

		if ( $body.hasClass( 'go-top-button' ) ) {
			var goTopButton = $( '#go-top-button' );

			$( window ).scroll( function () {
				if ( $( window ).scrollTop() > 1000 ) {
					goTopButton.css( "display", "inline-block" );
				} else {
					goTopButton.css( "display", "none" );
				}
			} );

			goTopButton.on( 'click', function ( e ) {
				e.preventDefault();
				$( 'html, body' ).animate( {
					scrollTop: 0
				}, '300' );
			} );
		}

		var navbarHeight = $( '#site-navigation' ).outerHeight();
		if ( $body.hasClass( 'fixed-navbar-top' ) ) {
			$body.css( 'padding-top', navbarHeight + 'px' );

			$( window ).scroll( function ( event ) {
				didScroll = true;
			} );

			setInterval( function () {
				if ( didScroll ) {
					hasScrolled();
					didScroll = false;
				}
			}, 250 );
		}

		// Navigation Slider
		var navbarSwiper = new Swiper( '.swiper-navbar-slider', {
			slidesPerView: 'auto',
			slideClass: 'nav-item',
			slidesOffsetBefore: 10,
			slidesOffsetAfter: 30,
		} );

		// Slides Per View Responsive
		if ( $body.hasClass( 'no-sidebar' ) ) {
			var cardsOnMd = 4;
			var cardsOnLarge = 6;
			var cardsOnExtraLarge = 7;
		} else {
			var cardsOnMd = 3;
			var cardsOnLarge = 4;
			var cardsOnExtraLarge = 6;
		}

		// Home Playlists Slider
		var homePlaylists = new Swiper( '.home-playlists-slider', {
			loop: true,
			navigation: {
				nextEl: '.home-playlists-next',
				prevEl: '.home-playlists-prev',
			},
			slidesPerView: 2,
			centeredSlides: true,
			spaceBetween: 5,
			breakpoints: {
				576: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: cardsOnMd,
				},
				992: {
					slidesPerView: cardsOnLarge,
				},
				1200: {
					slidesPerView: cardsOnExtraLarge,
				}
			}
		} );

		// Home Artists Slider
		var homeArtists = new Swiper( '.home-artists-slider', {
			loop: true,
			navigation: {
				nextEl: '.home-artists-next',
				prevEl: '.home-artists-prev',
			},
			slidesPerView: 2,
			centeredSlides: true,
			spaceBetween: 5,
			breakpoints: {
				576: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: cardsOnMd,
				},
				992: {
					slidesPerView: cardsOnLarge,
				},
				1200: {
					slidesPerView: cardsOnExtraLarge,
				}
			}
		} );

		// Home Albums Slider
		var homeAlbums = new Swiper( '.home-albums-slider', {
			loop: true,
			navigation: {
				nextEl: '.home-albums-next',
				prevEl: '.home-albums-prev',
			},
			slidesPerView: 2,
			centeredSlides: true,
			spaceBetween: 5,
			breakpoints: {
				576: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: cardsOnMd,
				},
				992: {
					slidesPerView: cardsOnLarge,
				},
				1200: {
					slidesPerView: cardsOnExtraLarge,
				}
			}
		} );

		// Page Slider
		var pageSlider = new Swiper( '.page-slider', {
			loop: true,
			navigation: {
				nextEl: '.page-next',
				prevEl: '.page-prev',
			},
			slidesPerView: 2,
			centeredSlides: true,
			spaceBetween: 10,
			breakpoints: {
				576: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: cardsOnMd,
				},
				992: {
					slidesPerView: cardsOnLarge,
				},
				1200: {
					slidesPerView: cardsOnExtraLarge,
				}
			}
		} );

		if ( $navigation.hasClass( 'has-sidenav' ) ) {
			var dropdownMenus = document.getElementsByClassName( 'dropdown-toggle nav-link' );

			for ( var i = 0; i < dropdownMenus.length; i += 1 ) {
				dropdownMenus[ i ].dataset.display = 'static';
			}
		}

		// Navbar Search Div
		$( '#searchModal' ).on( 'shown.bs.modal', function () {
			$( '#searchModal #search-form-input-small' ).trigger( 'focus' )
		} )

		//Comments Section
		$( '.show-comments-button' ).click( function () {
			$( '.comment-list' ).fadeToggle();
		} );

		// Comment Validation
		$( "#commentform" ).submit( function ( event ) {
			if ( $( ".comment-form-comment > #comment" ).val() ) {
				return;
			}
			$( ".comment-form-comment > #comment" ).addClass( "border-danger" );
			event.preventDefault();
		} );

		$( ".comment-form-comment > #comment" ).keyup( function () {
			$( ".comment-form-comment > #comment" ).removeClass( "border-danger" );
		} );

		if ( $( '#secondary-div #lyrics-embed-video' ).length ) {
			// it exists

			var check = true;
			$( "#close-embed-video" ).click( function () {
				$( "#lyrics-embed-video" ).removeClass( "fixed-embed" );
				$( "#close-embed-video" ).hide();
				check = false;
			} );

			var iframeDiv = document.getElementById( 'lyrics-embed-video' );
			var sidebar = document.getElementById( 'secondary-div' );
			var totalHeight = iframeDiv.offsetHeight + sidebar.offsetTop + 10;

			// fakeHeight avoids pushing item to top when video become fixed.
			var fakeHeight = iframeDiv.offsetHeight;

			//  var totalHeight = obj1.offsetHeight;
			window.onscroll = function () {
				myFunction( totalHeight, fakeHeight )
			};

			function myFunction( total, x ) {
				if ( check === true ) {

					if ( document.body.scrollTop > total || document.documentElement.scrollTop > total ) {
						$( "#lyrics-embed-video" ).addClass( "fixed-embed" );
						$( "#close-embed-video" ).show();
					} else {
						$( "#lyrics-embed-video" ).removeClass( "fixed-embed" );
						$( "#close-embed-video" ).hide();
					}

				}


			}
		}
		//Panel Arrow animation
		$( '.collapse' ).on( 'show.bs.collapse', function () {
			$( this ).siblings( '.card-header' ).addClass( 'active' );
		} );

		$( '.collapse' ).on( 'hide.bs.collapse', function () {
			$( this ).siblings( '.card-header' ).removeClass( 'active' );
		} );

		// Dont show table if there is no info inside. Avoiding margin problem.
		if ( !$( 'table.table-song-info > tbody > tr' ).length > 0 ) {
			$( "table.table-song-info" ).css( "display", "none" );
		}

		//AJAX
		$( document ).on( 'click', '.lyrico-load-more:not(.loading)', function () {

			var that = $( this );
			var page = $( this ).data( 'page' );
			var total_pages = $( this ).data( 'total-pages' );
			var newPage = page + 1;
			var ajaxurl = $( this ).data( 'url' );

			that.addClass( 'loading' ).find( '.load-more-text' ).slideUp( 350 );
			that.find( '.load-more-icon' ).addClass( 'spin' );

			$.ajax( {
				url: ajaxurl,
				type: 'post',
				data: {
					page: page,
					action: 'lyrico_load_more'
				},
				error: function ( response ) {
					console.log( response );
				},
				success: function ( response ) {

					setTimeout( function () {

						that.data( 'page', newPage );
						$( '.all-posts-container.with-ajax-load-more' ).append( response );
						that.removeClass( 'loading' ).find( '.load-more-text' ).slideDown( 350 );
						that.find( '.load-more-icon' ).removeClass( 'spin' );

						revealPosts();

						if ( page === total_pages - 1 ) {
							that.hide();
							$( '.all-posts-container.with-ajax-load-more' ).append( '<div class="text-center container mt-4"><h3> You reached the end of the line. </h3><p>No more posts to load.</p></div>' );

						}
					}, 200 );

				}
			} );
		} );
	} );

	function hasScrolled() {
		var navbarHeight = $( '#site-navigation' ).outerHeight();
		var st = $( this ).scrollTop();
		// Make sure they scroll more than delta
		if ( Math.abs( lastScrollTop - st ) <= delta )
			return;

		// If they scrolled down and are past the navbar, add class .nav-up.
		// This is necessary so you never see what is "behind" the navbar.
		if ( st > lastScrollTop && st > navbarHeight ) {
			// Scroll Down
			$( '#site-navigation' ).css( 'top', '-' + navbarHeight + 'px' );
			$( '#site-navigation' ).addClass('top');
		} else {
			// Scroll Up
			if ( st + $( window ).height() < $( document ).height() ) {
				$( '#site-navigation' ).css( 'top', '0px' );
				$( '#site-navigation' ).removeClass('top');
			}
		}

		lastScrollTop = st;
	}

	function revealPosts() {

		var posts = $( '.with-ajax-load-more .post-component-wrapper:not(.reveal)' );
		var i = 0;
		setInterval( function () {

			if ( i >= posts.length ) {
				return false;
			}

			var el = posts[ i ];
			$( el ).addClass( 'reveal' );

			i++;

		}, 100 );
	}

} )( jQuery );