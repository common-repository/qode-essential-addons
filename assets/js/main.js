(function ( $ ) {
	'use strict';

	window.qodefCore     = {};
	qodefCore.shortcodes = {};

	qodefCore.body         = $( 'body' );
	qodefCore.html         = $( 'html' );
	qodefCore.windowWidth  = $( window ).width();
	qodefCore.windowHeight = $( window ).height();
	qodefCore.scroll       = 0;

	$( document ).ready(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
			qodefSwiper.init();
			qodefFsLightboxPopup.init();
			qodefInlinePageStyle.init();
		}
	);

	$( window ).resize(
		function () {
			qodefCore.windowWidth  = $( window ).width();
			qodefCore.windowHeight = $( window ).height();
		}
	);

	$( window ).scroll(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
		}
	);

	/**
	 * Init swiper slider
	 */
	var qodefSwiper = {
		init: function ( settings ) {
			this.holder = $( '.qodef-swiper-container' );

			// Allow overriding the default config.
			$.extend(
				this.holder,
				settings
			);

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefSwiper.createSlider( $( this ) );
					}
				);
			}
		},
		createSlider: function ( $holder ) {
			var options = qodefSwiper.getOptions( $holder ),
				events  = qodefSwiper.getEvents(
					$holder,
					options
				);

			if ( ! $holder.hasClass( 'qodef-swiper--initialized' ) ) {
				var $swiper = new Swiper(
					$holder[0],
					Object.assign(
						options,
						events
					)
				);
			}
		},
		getOptions: function ( $holder ) {
			var sliderOptions     = typeof $holder.data( 'options' ) !== 'undefined' ? $holder.data( 'options' ) : {},
				spaceBetween      = sliderOptions.spaceBetween !== undefined && sliderOptions.spaceBetween !== '' ? sliderOptions.spaceBetween : 0,
				slidesPerView     = sliderOptions.slidesPerView !== undefined && sliderOptions.slidesPerView !== '' ? sliderOptions.slidesPerView : 1,
				centeredSlides    = sliderOptions.centeredSlides !== undefined && sliderOptions.centeredSlides !== '' ? sliderOptions.centeredSlides : false,
				sliderScroll      = sliderOptions.sliderScroll !== undefined && sliderOptions.sliderScroll !== '' ? sliderOptions.sliderScroll : false,
				loop              = sliderOptions.loop !== undefined && sliderOptions.loop !== '' ? sliderOptions.loop : true,
				autoplay          = sliderOptions.autoplay !== undefined && sliderOptions.autoplay !== '' ? sliderOptions.autoplay : true,
				speed             = sliderOptions.speed !== undefined && sliderOptions.speed !== '' ? parseInt( sliderOptions.speed, 10 ) : 5000,
				speedAnimation    = sliderOptions.speedAnimation !== undefined && sliderOptions.speedAnimation !== '' ? parseInt( sliderOptions.speedAnimation, 10 ) : 800,
				customStages      = sliderOptions.customStages !== undefined && sliderOptions.customStages !== '' ? sliderOptions.customStages : false,
				outsideNavigation = sliderOptions.outsideNavigation !== undefined && sliderOptions.outsideNavigation === 'yes',
				nextNavigation    = outsideNavigation ? '.swiper-button-next-' + sliderOptions.unique : ($holder.find( '.swiper-button-next' ).length ? $holder.find( '.swiper-button-next' )[0] : null),
				prevNavigation    = outsideNavigation ? '.swiper-button-prev-' + sliderOptions.unique : ($holder.find( '.swiper-button-prev' ).length ? $holder.find( '.swiper-button-prev' )[0] : null),
				pagination        = $holder.find( '.swiper-pagination' )[0];

			if ( autoplay !== false && speed !== 5000 ) {
				autoplay = {
					delay: speed
				};
			}

			var slidesPerView1680 = sliderOptions.slidesPerView1680 !== undefined && sliderOptions.slidesPerView1680 !== '' ? parseInt( sliderOptions.slidesPerView1680, 10 ) : 5,
				slidesPerView1440 = sliderOptions.slidesPerView1440 !== undefined && sliderOptions.slidesPerView1440 !== '' ? parseInt( sliderOptions.slidesPerView1440, 10 ) : 5,
				slidesPerView1366 = sliderOptions.slidesPerView1366 !== undefined && sliderOptions.slidesPerView1366 !== '' ? parseInt( sliderOptions.slidesPerView1366, 10 ) : 4,
				slidesPerView1024 = sliderOptions.slidesPerView1024 !== undefined && sliderOptions.slidesPerView1024 !== '' ? parseInt( sliderOptions.slidesPerView1024, 10 ) : 3,
				slidesPerView768  = sliderOptions.slidesPerView768 !== undefined && sliderOptions.slidesPerView768 !== '' ? parseInt( sliderOptions.slidesPerView768, 10 ) : 2,
				slidesPerView680  = sliderOptions.slidesPerView680 !== undefined && sliderOptions.slidesPerView680 !== '' ? parseInt( sliderOptions.slidesPerView680, 10 ) : 1,
				slidesPerView480  = sliderOptions.slidesPerView480 !== undefined && sliderOptions.slidesPerView480 !== '' ? parseInt( sliderOptions.slidesPerView480, 10 ) : 1;

			if ( ! customStages ) {
				if ( slidesPerView < 2 ) {
					slidesPerView1680 = slidesPerView;
					slidesPerView1440 = slidesPerView;
					slidesPerView1366 = slidesPerView;
					slidesPerView1024 = slidesPerView;
					slidesPerView768  = slidesPerView;
				} else if ( slidesPerView < 3 ) {
					slidesPerView1680 = slidesPerView;
					slidesPerView1440 = slidesPerView;
					slidesPerView1366 = slidesPerView;
					slidesPerView1024 = slidesPerView;
				} else if ( slidesPerView < 4 ) {
					slidesPerView1680 = slidesPerView;
					slidesPerView1440 = slidesPerView;
					slidesPerView1366 = slidesPerView;
				} else if ( slidesPerView < 5 ) {
					slidesPerView1680 = slidesPerView;
					slidesPerView1440 = slidesPerView;
				}
			}

			var options = {
				slidesPerView: slidesPerView,
				centeredSlides: centeredSlides,
				sliderScroll: sliderScroll,
				spaceBetween: spaceBetween,
				autoplay: autoplay,
				loop: loop,
				speed: speedAnimation,
				navigation: { nextEl: nextNavigation, prevEl: prevNavigation },
				pagination: { el: pagination, type: 'bullets', clickable: true },
				breakpoints: {
					// when window width is < 481px.
					0: {
						slidesPerView: slidesPerView480
					},
					// when window width is >= 481px.
					481: {
						slidesPerView: slidesPerView680
					},
					// when window width is >= 681px.
					681: {
						slidesPerView: slidesPerView768
					},
					// when window width is >= 769px.
					769: {
						slidesPerView: slidesPerView1024
					},
					// when window width is >= 1025px.
					1025: {
						slidesPerView: slidesPerView1366
					},
					// when window width is >= 1367px.
					1367: {
						slidesPerView: slidesPerView1440
					},
					// when window width is >= 1441px.
					1441: {
						slidesPerView: slidesPerView1680
					},
					// when window width is >= 1681px.
					1681: {
						slidesPerView: slidesPerView
					}
				},
			};

			return Object.assign(
				options,
				qodefSwiper.getSliderDatas( $holder )
			);
		},
		getSliderDatas: function ( $holder ) {
			var dataList    = $holder.data(),
				returnValue = {};

			for ( var property in dataList ) {
				if ( dataList.hasOwnProperty( property ) ) {
					// It's required to be different from data options because da options are all options from shortcode element.
					if ( property !== 'options' && typeof dataList[property] !== 'undefined' && dataList[property] !== '' ) {
						returnValue[property] = dataList[property];
					}
				}
			}

			return returnValue;
		},
		getEvents: function ( $holder, options ) {
			return {
				on: {
					init: function () {
						$holder.addClass( 'qodef-swiper--initialized' );

						if ( options.sliderScroll ) {
							var scrollStart = false;

							$holder.on(
								'mousewheel',
								function ( e ) {
									e.preventDefault();

									if ( ! scrollStart ) {
										scrollStart = true;

										if ( e.deltaY < 0 ) {
											$holder[0].swiper.slideNext();
										} else {
											$holder[0].swiper.slidePrev();
										}

										setTimeout(
											function () {
												scrollStart = false;
											},
											1000
										);
									}
								}
							);
						}
					}
				}
			};
		}
	};

	qodefCore.qodefSwiper = qodefSwiper;

	if ( typeof Object.assign !== 'function' ) {
		Object.assign = function ( target ) {

			if ( target === null || typeof target === 'undefined' ) {
				throw new TypeError( 'Cannot convert undefined or null to object' );
			}

			target = Object( target );
			// phpcs:ignore Squiz.PHP.DisallowSizeFunctionsInLoops.Found
			for ( var index = 1; index < arguments.length; index++ ) {
				var source = arguments[index];

				if ( source !== null ) {
					for ( var key in source ) {
						if ( Object.prototype.hasOwnProperty.call(
							source,
							key
						) ) {
							target[key] = source[key];
						}
					}
				}
			}

			return target;
		};
	}

	/**
	 * Init fslightbox popup galleries
	 */
	var qodefFsLightboxPopup = {
		init: function () {
			this.holder = $( '.qodef-fslightbox-popup' );

			if ( this.holder.length ) {
				refreshFsLightbox();

				for ( const instance in fsLightboxInstances ) {

					fsLightboxInstances[instance].props.onInit = () =>
					{
						var $fsLightboxHolder = fsLightboxInstances[instance].elements.container,
							$prevHolder       = $fsLightboxHolder.querySelectorAll( '.fslightbox-slide-btn-container-previous > .fslightbox-slide-btn' ),
							$nextHolder       = $fsLightboxHolder.querySelectorAll( '.fslightbox-slide-btn-container-next > .fslightbox-slide-btn' ),
							$closeHolder      = $fsLightboxHolder.querySelectorAll( '[title="Close"]' );

						if ( this.holder.hasClass( 'qodef-popup-caption--on' ) ) {
							var $fsLightboxItems = $fsLightboxHolder.querySelectorAll( '.fslightbox-absoluted' );

							if ( $fsLightboxItems ) {
								$fsLightboxItems.forEach(
									function ( $fsLightboxItem ) {
										var observer = new MutationObserver(
											function ( mutations ) {
												mutations.forEach(
													function ( mutationRecord ) {
														var $fsLightboxItemImg = mutationRecord.target.querySelector( 'img' );

														if ( $fsLightboxItemImg && $fsLightboxItemImg.getAttribute( 'caption' ) && ! mutationRecord.target.querySelector( '.qodef-fslightbox-caption' ) ) {
															$fsLightboxItemImg.classList.add( 'fslightbox-opacity-1' );

															$fsLightboxItemImg.outerHTML = $fsLightboxItemImg.outerHTML + '<p class="qodef-fslightbox-caption">' + $fsLightboxItemImg.getAttribute( 'caption' ) + '</p>';
														}
													}
												);
											}
										);

										observer.observe(
											$fsLightboxItem,
											{
												attributes: true,
												attributeFilter: ['style']
											}
										);
									}
								);
							}
						}

						if ( $prevHolder.length ) {
							$prevHolder[0].innerHTML = qodefGlobal.vars.iconArrowLeft;
						}

						if ( $nextHolder.length ) {
							$nextHolder[0].innerHTML = qodefGlobal.vars.iconArrowRight;
						}

						if ( $closeHolder.length ) {
							$closeHolder[0].innerHTML = qodefGlobal.vars.iconClose;
						}
					};
				}
			}
		},
	};

	qodefCore.qodefFsLightboxPopup = qodefFsLightboxPopup;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $( '#qode-essential-addons-page-inline-style' );

			if ( this.holder.length ) {
				var style = this.holder.data( 'style' );

				if ( style.length ) {
					$( 'head' ).append( '<style type="text/css">' + style + '</style>' );
				}
			}
		}
	};

	/**
	 * Check element images to loaded
	 */
	var qodefWaitForImages = {
		check: function ( $element, callback ) {
			if ( $element.length ) {
				var images = $element.find( 'img' );

				if ( images.length ) {
					var counter = 0;

					// phpcs:ignore Squiz.PHP.DisallowSizeFunctionsInLoops.Found
					for ( var index = 0; index < images.length; index++ ) {
						var img = images[index];

						if ( img.complete ) {
							counter++;
							if ( counter === images.length ) {
								callback.call( $element );
							}
						} else {
							var image = new Image();

							image.addEventListener(
								'load',
								function () {
									counter++;
									if ( counter === images.length ) {
										callback.call( $element );
										return false;
									}
								},
								false
							);
							image.src = img.src;
						}
					}
				} else {
					callback.call( $element );
				}
			}
		},
	};

	qodefCore.qodefWaitForImages = qodefWaitForImages;

	var qodefInfoFollow = {
		init: function ( $holder, additionalClass = '' ) {
			if ( $holder.length ) {
				qodefCore.body.append( '<div class="qodef-e-content-follow ' + additionalClass + '"><div class="qodef-e-content"></div></div>' );

				var $contentFollow = $( '.qodef-e-content-follow' ),
					$content       = $contentFollow.find( '.qodef-e-content' );

				if ( qodefCore.windowWidth > 1024 ) {
					$holder.each(
						function () {
							var $thisGallery = $( this );

							$thisGallery.find( '.qodef-e-inner' ).each(
								function () {
									var $thisItem = $( this );

									// info element position.
									$thisItem.on(
										'mousemove',
										function ( e ) {
											if ( e.clientX + $contentFollow.width() + 20 > qodefCore.windowWidth ) {
												$contentFollow.addClass( 'qodef-right' );
											} else {
												$contentFollow.removeClass( 'qodef-right' );
											}

											$contentFollow.css(
												{
													top: e.clientY + 20,
													left: e.clientX + 20
												}
											);
										}
									);

									// show/hide info element.
									$thisItem.on(
										'mouseenter',
										function () {
											var $thisItemContent = $( this ).find( '.qodef-e-content' );

											if ( $thisItemContent.length ) {
												$content.html( $thisItemContent.html() );
											}

											if ( ! $contentFollow.hasClass( 'qodef-is-active' ) ) {
												$contentFollow.addClass( 'qodef-is-active' );
											} else {
												$contentFollow.removeClass( 'qodef-is-active' );
												setTimeout(
													function () {
														$contentFollow.addClass( 'qodef-is-active' );
													},
													10
												);
											}
										}
									).on(
										'mouseleave',
										function () {
											if ( $contentFollow.hasClass( 'qodef-is-active' ) ) {
												$contentFollow.removeClass( 'qodef-is-active' );
											}
										}
									);

									$( window ).on(
										'wheel',
										function () {
											if ( $contentFollow.hasClass( 'qodef-is-active' ) ) {
												$contentFollow.removeClass( 'qodef-is-active' );
											}
										}
									);
								}
							);
						}
					);
				}
			}
		}
	};

	qodefCore.qodefInfoFollow = qodefInfoFollow;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFullscreenMenu.init();
		}
	);

	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' ),
				$fullscreenMenuClose  = $( 'a.qodef-fullscreen-menu-close' ),
				$menuItems            = $( '#qodef-fullscreen-area nav ul li a' );

			// Open popup menu.
			$fullscreenMenuOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();
					var $thisOpener = $( this );

					if ( ! qodefCore.body.hasClass( 'qodef-fullscreen-menu--opened' ) ) {
						qodefFullscreenMenu.openFullscreen( $thisOpener );

						$fullscreenMenuClose.on(
							'click',
							function ( e ) {
								e.preventDefault();

								qodefFullscreenMenu.closeFullscreen( $thisOpener );
							}
						);

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefFullscreenMenu.closeFullscreen( $thisOpener );
								}
							}
						);
					} else {
						qodefFullscreenMenu.closeFullscreen( $thisOpener );
					}
				}
			);

			// Open dropdowns.
			$menuItems.on(
				'tap click',
				function ( e ) {
					var $thisItem = $( this );

					if ( $thisItem.parent().hasClass( 'menu-item-has-children' ) ) {
						e.preventDefault();
						qodefFullscreenMenu.clickItemWithChild( $thisItem );
					} else if ( $thisItem.attr( 'href' ) !== 'http://#' && $thisItem.attr( 'href' ) !== '#' ) {
						qodefFullscreenMenu.closeFullscreen( $fullscreenMenuOpener );
					}
				}
			);
		},
		openFullscreen: function ( $opener ) {
			$opener.addClass( 'qodef--opened' ).attr( 'aria-expanded', 'true' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu-animate--out' ).addClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' );
		},
		closeFullscreen: function ( $opener ) {
			$opener.removeClass( 'qodef--opened' ).attr( 'aria-expanded', 'false' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' ).addClass( 'qodef-fullscreen-menu-animate--out' );
			$( 'nav.qodef-fullscreen-menu ul.sub_menu' ).slideUp( 200 );
		},
		clickItemWithChild: function ( thisItem ) {
			var $thisItemParent  = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find( '.sub-menu' ).first();

			if ( $thisItemSubMenu.is( ':visible' ) ) {
				$thisItemSubMenu.slideUp( 300 );
				$thisItemParent.removeClass( 'qodef--opened' );
			} else {
				$thisItemSubMenu.slideDown( 300 );
				$thisItemParent.addClass( 'qodef--opened' ).siblings().find( '.sub-menu' ).slideUp( 400 );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefBackToTop.init();
		}
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top.
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			var startPos = qodefCore.scroll,
				newPos   = qodefCore.scroll,
				step     = .9,
				animationFrameId;

			var startAnimation = function () {
				if ( 0 === newPos ) {
					return;
				}
				newPos < 0.0001 ? newPos = 0 : null;

				var ease = qodefBackToTop.easingFunction( (startPos - newPos) / startPos );
				$( 'html, body' ).scrollTop( startPos - (startPos - newPos) * ease );
				newPos = newPos * step;

				animationFrameId = requestAnimationFrame( startAnimation );
			};
			startAnimation();
			$( window ).one(
				'wheel touchstart',
				function () {
					cancelAnimationFrame( animationFrameId );
				}
			);
		},
		easingFunction: function ( n ) {
			return 0 === n ? 0 : Math.pow( 1024, n - 1 );
		},
		showHideBackToTop: function () {
			$( window ).scroll(
				function () {
					var $thisItem = $( this ),
						b         = $thisItem.scrollTop(),
						c         = $thisItem.height(),
						d;

					if ( b > 0 ) {
						d = b + c / 2;
					} else {
						d = 1;
					}

					if ( d < 1e3 ) {
						qodefBackToTop.addClass( 'off' );
					} else {
						qodefBackToTop.addClass( 'on' );
					}
				}
			);
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( 'on' === a ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefMasonryLayout.init();
		}
	);

	$( window ).resize(
		function () {
			qodefMasonryLayout.reInit();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			if ( elementorFrontend.isEditMode() ) {
				elementor.channels.editor.on(
					'change',
					function () {
						qodefMasonryLayout.reInit();
					}
				);
			}
		}
	);

	/**
	 * Init masonry layout
	 */
	var qodefMasonryLayout = {
		init: function ( settings ) {
			this.holder = $( '.qodef-layout--masonry' );

			// Allow overriding the default config.
			$.extend(
				this.holder,
				settings
			);

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefMasonryLayout.createMasonry( $( this ) );
					}
				);
			}
		},
		reInit: function ( settings ) {
			this.holder = $( '.qodef-layout--masonry' );

			// Allow overriding the default config.
			$.extend(
				this.holder,
				settings
			);

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $masonry            = $( this ).hasClass( 'qodef-woo-product-list' ) ? $( this ).find( 'ul.products' ) : $( this ).find( '.qodef-grid-inner' ),
							$masonryItem        = $masonry.find( '.qodef-grid-item' ),
							$masonryItemSize    = $masonry.find( '.qodef-grid-masonry-sizer' ).width(),
							$masonryItemSizeGap = parseInt( $masonry.css( 'column-gap' ) );

						$masonryItem.css(
							'width',
							$masonryItemSize
						);

						if ( typeof $masonry.isotope === 'function' && undefined !== $masonry.data( 'isotope' ) ) {

							if ( $( this ).hasClass( 'qodef-items--fixed' ) ) {

								qodefMasonryLayout.setFixedImageProportionSize(
									$masonry,
									$masonryItem,
									$masonryItemSize,
									$masonryItemSizeGap
								);
							}

							$masonry.isotope(
								{
									layoutMode: 'packery',
									itemSelector: '.qodef-grid-item',
									percentPosition: true,
									packery: {
										columnWidth: '.qodef-grid-masonry-sizer',
										gutter: $masonryItemSizeGap,
									}
								}
							);
						}
					}
				);
			}
		},
		createMasonry: function ( $holder ) {
			if ( $holder.hasClass( 'qodef-woo-product-list' ) ) {
				$holder.find( 'ul.products' ).prepend( '<li class="qodef-grid-masonry-sizer"></li>' );
			}

			var $masonry            = $holder.hasClass( 'qodef-woo-product-list' ) ? $holder.find( 'ul.products' ) : $holder.find( '.qodef-grid-inner' ),
				$masonryItem        = $masonry.find( '.qodef-grid-item' ),
				$masonryItemSize    = $masonry.find( '.qodef-grid-masonry-sizer' ).width(),
				$masonryItemSizeGap = parseInt( $masonry.css( 'column-gap' ) );

			$masonryItem.css(
				'width',
				$masonryItemSize
			);

			qodefCore.qodefWaitForImages.check(
				$masonry,
				function () {
					if ( typeof $masonry.isotope === 'function' && ! $masonry.hasClass( 'qodef--masonry-init' ) ) {

						if ( $holder.hasClass( 'qodef-items--fixed' ) ) {

							qodefMasonryLayout.setFixedImageProportionSize(
								$masonry,
								$masonryItem,
								$masonryItemSize,
								$masonryItemSizeGap
							);
						}

						$masonry.isotope(
							{
								layoutMode: 'packery',
								itemSelector: '.qodef-grid-item',
								percentPosition: true,
								packery: {
									columnWidth: '.qodef-grid-masonry-sizer',
									gutter: $masonryItemSizeGap,
								}
							}
						);
					}

					$masonry.addClass( 'qodef--masonry-init' );
				}
			);
		},
		setFixedImageProportionSize: function ( $holder, $item, size, $gap ) {

			var $squareItem     = $holder.find( '.qodef-item--square' ),
				$landscapeItem  = $holder.find( '.qodef-item--landscape' ),
				$portraitItem   = $holder.find( '.qodef-item--portrait' ),
				$hugeSquareItem = $holder.find( '.qodef-item--huge-square' ),
				isMobileScreen  = qodefCore.windowWidth <= 680;

			if ( ! $holder.parent().hasClass( 'qodef-col-num--1' ) ) {

				$item.css(
					{
						'height': size,
					}
				);

				if ( $landscapeItem.length ) {
					$landscapeItem.css(
						{
							'width': Math.round( (2 * size) + $gap ),
						}
					);
				}

				if ( $portraitItem.length ) {
					$portraitItem.css(
						{
							'height': Math.round( (2 * size) + $gap ),
						}
					);
				}

				if ( $hugeSquareItem.length ) {
					$hugeSquareItem.css(
						{
							'height': Math.round( (2 * size) + $gap ),
							'width': Math.round( (2 * size) + $gap ),
						}
					);
				}

				if ( isMobileScreen ) {

					if ( $landscapeItem.length ) {
						$landscapeItem.css(
							{
								'height': Math.round( size / 2 ),
								'width': Math.round( size ),
							}
						);
					}

					if ( $hugeSquareItem.length ) {
						$hugeSquareItem.css(
							{
								'height': Math.round( size ),
								'width': Math.round( size ),
							}
						);
					}
				}
			} else {

				$item.css(
					{
						'height': size,
					}
				);

				if ( $squareItem.length ) {
					$squareItem.css(
						{
							'width': size,
						}
					);
				}

				if ( $landscapeItem.length ) {
					$landscapeItem.css(
						{
							'height': Math.round( size / 2 ),
						}
					);
				}

				if ( $portraitItem.length ) {
					$portraitItem.css(
						{
							'height': Math.round( (2 * size) ),
						}
					);
				}

				if ( $hugeSquareItem.length ) {
					$hugeSquareItem.css(
						{
							'width': size,
						}
					);
				}
			}
		}
	};

	qodefCore.qodefMasonryLayout = qodefMasonryLayout;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefVerticalNavMenu.init();
		}
	);

	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalNavMenu = {
		init: function () {
			var $verticalNavObject = $( '#qodef-page-header .qodef-header-vertical-navigation' );

			qodefVerticalNavMenu.dropdownClickToggle( $verticalNavObject );
		},
		dropdownClickToggle: function ( $verticalNavObject ) {
			var $menuItems = $verticalNavObject.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $menuItem        = $( this ),
						$elementToExpand = $menuItem.find( '> ul' ),
						$dropdownOpener  = $menuItem.find( '> a' ),
						slideUpSpeed     = 'fast',
						slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							var $clickedItem = $( this );

							if ( $elementToExpand.is( ':visible' ) ) {
								$menuItem.removeClass( 'qodef--opened' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef--opened' ) ) {
								$clickedItem.parent().parent().children().removeClass( 'qodef--opened' );
								$clickedItem.parent().parent().children().find( '> ul' ).slideUp( slideUpSpeed );

								$menuItem.addClass( 'qodef--opened' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $clickedItem.parents( 'li' ).hasClass( 'qodef--opened' ) ) {
									$menuItems.removeClass( 'qodef--opened' );
									$menuItems.find( '> ul' ).slideUp( slideUpSpeed );
								}

								if ( $clickedItem.parent().parent().children().hasClass( 'qodef--opened' ) ) {
									$clickedItem.parent().parent().children().removeClass( 'qodef--opened' );
									$clickedItem.parent().parent().children().find( '> ul' ).slideUp( slideUpSpeed );
								}

								$menuItem.addClass( 'qodef--opened' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefHeaderScrollAppearance.init();
		}
	);

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr( 'class' ).indexOf( 'qodef-header-appearance--' ) !== -1 ? qodefCore.body.attr( 'class' ).match( /qodef-header-appearance--([\w]+)/ )[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if ( appearanceType !== '' && appearanceType !== 'none' ) {
				qodefCore[appearanceType + 'HeaderAppearance']();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideArea.init();
		}
	);

	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $( 'a.qodef-side-area-opener' ),
				$sideAreaClose  = $( '#qodef-side-area-close' );

			qodefSideArea.openerHoverColor( $sideAreaOpener );
			// Open Side Area.
			$sideAreaOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					var $clickedOpener = $( this );

					if ( ! qodefCore.body.hasClass( 'qodef-side-area--opened' ) ) {
						qodefSideArea.openSideArea( $clickedOpener );

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefSideArea.closeSideArea();
								}
							}
						);
					} else {
						qodefSideArea.closeSideArea();
					}
				}
			);

			$sideAreaClose.on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);
			qodefSideArea.initScroll();
		},
		openSideArea: function ( $opener ) {
			$opener.attr( 'aria-expanded', 'true' );

			var $wrapper      = $( '#qodef-page-wrapper' );
			var currentScroll = $( window ).scrollTop();

			$( '.qodef-side-area-cover' ).remove();
			$wrapper.prepend( '<div class="qodef-side-area-cover"/>' );
			qodefCore.body.removeClass( 'qodef-side-area-animate--out' ).addClass( 'qodef-side-area--opened qodef-side-area-animate--in' );

			$( '.qodef-side-area-cover' ).on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			$( window ).scroll(
				function () {
					if ( Math.abs( qodefCore.scroll - currentScroll ) > 400 ) {
						qodefSideArea.closeSideArea();
					}
				}
			);
		},
		closeSideArea: function () {
			$( 'a.qodef-side-area-opener' ).attr( 'aria-expanded', 'false' );
			qodefCore.body.removeClass( 'qodef-side-area--opened qodef-side-area-animate--in' ).addClass( 'qodef-side-area-animate--out' );
		},
		openerHoverColor: function ( $opener ) {
			if ( typeof $opener.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $opener.data( 'hover-color' );
				var originalColor = $opener.css( 'color' );

				$opener.on(
					'mouseenter',
					function () {
						$opener.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$opener.css( 'color', originalColor );
					}
				);
			}
		},
		initScroll: function () {
			var $sideArea = $( '#qodef-side-area-inner' );

			if ( $sideArea.length ) {
				var $defaultParams = {
					wheelSpeed: 0.6,
					suppressScrollX: true
				};

				var $ps = new PerfectScrollbar(
					$sideArea.parent()[0],
					$defaultParams
				);

				$( window ).resize(
					function () {
						$ps.update();
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefDeactivationModal.init();
		}
	);

	var qodefDeactivationModal = {
		init: function () {
			this.deactivationLink  = $( '#the-list' ).find( '[data-slug="qode-essential-addons"] span.deactivate a' );
			this.deactivationModal = $( '#qode-essential-addons-deactivation-modal' );

			if ( this.deactivationLink.length && this.deactivationModal.length ) {
				this.initModal();
			}
		},
		initModal: function () {
			this.deactivationLink.on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefDeactivationModal.deactivationModal.fadeIn( 'fast' );
				}
			);

			this.enableModalCloseFunctionality();
			this.initSubmitFunctionality();
			this.initSkipFunctionality();
		},
		enableSubmitButton: function () {
			var radioButtons = this.deactivationModal.find( 'input[name="reason_key"]' ),
				submitButton = this.deactivationModal.find( '.qodef-deactivation-modal-button-submit' );

			radioButtons.on(
				'change',
				function () {
					submitButton.removeClass( 'qodef--disabled' );
				}
			);
		},
		initSubmitFunctionality: function () {
			var submitButton = this.deactivationModal.find( '.qodef-deactivation-modal-button-submit' ),
				skipButton   = this.deactivationModal.find( '.qodef-deactivation-modal-button-skip' ),
				nonceHolder  = this.deactivationModal.find( '#qode-essential-addons-deactivation-nonce' );

			if ( submitButton.length ) {
				submitButton.on(
					'click',
					function ( e ) {
						e.preventDefault();
						submitButton.addClass( 'qodef--processing' );
						skipButton.addClass( 'qodef--disabled' );

						var reason = qodefDeactivationModal.deactivationModal.find( 'input[name="reason_key"]:checked' ).val(),
							additionalInfo;

						switch (reason) {
							case 'found_a_better_plugin':
								additionalInfo = qodefDeactivationModal.deactivationModal.find( 'input[name="reason_found_a_better_plugin"]' ).val();
								break;
							case 'other':
								additionalInfo = qodefDeactivationModal.deactivationModal.find( 'input[name="reason_other"]' ).val();
								break;
							default:
								additionalInfo = '';
						}

						$.ajax(
							{
								type: 'POST',
								data: {
									action: 'qode_essential_addons_deactivation',
									reason: reason,
									additionalInfo: additionalInfo,
									nonce: nonceHolder.val()
								},
								url: ajaxurl,
								success: function () {
									qodefDeactivationModal.deactivatePlugin();
								}
							}
						);
					}
				);
			}
		},
		initSkipFunctionality: function () {
			var submitButton = this.deactivationModal.find( '.qodef-deactivation-modal-button-submit' ),
				skipButton   = this.deactivationModal.find( '.qodef-deactivation-modal-button-skip' );

			if ( skipButton.length ) {
				skipButton.on(
					'click',
					function ( e ) {
						e.preventDefault();
						skipButton.addClass( 'qodef--processing' );
						submitButton.addClass( 'qodef--disabled' );
						qodefDeactivationModal.deactivatePlugin();
					}
				);
			}
		},
		deactivatePlugin: function () {
			location.href = this.deactivationLink.attr( 'href' );
		},
		enableModalCloseFunctionality: function () {
			var closeButton = this.deactivationModal.find( '.qodef-deactivation-modal-close' );

			if ( closeButton.length ) {
				closeButton.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefDeactivationModal.deactivationModal.fadeOut( 'fast' );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'qode_essential_addons_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	$( document ).ready(
		function () {
			qodefCoreResizeIframes.init();
		}
	);

	$( window ).resize(
		function () {
			qodefCoreResizeIframes.init();
		}
	);

	/**
	 * Resize oembed iframes
	 */
	var qodefCoreResizeIframes = {
		init: function () {
			var $holder = $( '.qodef-blog-shortcode' );

			if ( $holder.length ) {
				qodefCoreResizeIframes.resize( $holder );
			}
		},
		resize: function ( $holder ) {
			var $iframe = $holder.find( '.qodef-e-media iframe' );

			if ( $iframe.length ) {
				$iframe.each(
					function () {
						// rendered width divided by aspect ratio.
						var $thisIframe = $( this ),
							width       = $thisIframe.attr( 'width' ),
							height      = $thisIframe.attr( 'height' ),
							newHeight   = $thisIframe.width() / width * height;

						$thisIframe.css( 'height', newHeight );
					}
				);
			}
		}
	};

	qodefCore.shortcodes[shortcode].qodefSwiper            = qodefCore.qodefSwiper;
	qodefCore.shortcodes[shortcode].qodefFsLightboxPopup   = qodefCore.qodefFsLightboxPopup;
	qodefCore.shortcodes[shortcode].qodefMasonryLayout     = qodefCore.qodefMasonryLayout;
	qodefCore.shortcodes[shortcode].qodefCoreResizeIframes = qodefCoreResizeIframes;

})( jQuery );

(function ( $ ) {
	'use strict';

	var fixedHeaderAppearance = {
		showHideHeader: function ( $pageOuter, $header ) {

			var $headerMargin = parseInt( $header.css( 'margin-top' ) ) + parseInt( $header.css( 'margin-bottom' ) );

			if ( qodefCore.windowWidth > 1024 ) {

				var $elementorSectionBeforeHeader      = $( '.qodef-elementor-section-before-header' );
				var elementorSectionBeforeHeaderHeight = $elementorSectionBeforeHeader.length ? $elementorSectionBeforeHeader.height() : 0;

				if ( qodefCore.scroll <= elementorSectionBeforeHeaderHeight ) {
					qodefCore.body.removeClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', '0' );
					$header.css( 'top', '' );
				} else {
					qodefCore.body.addClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight + $headerMargin ) + 'px' );
					$header.css( 'top', parseInt( qodefGlobal.vars.topAreaHeight + qodefGlobal.vars.adminBarHeight ) + 'px' );
				}
			}
		},
		init: function () {

			if ( ! qodefCore.body.hasClass( 'qodef-header--vertical' ) ) {
				var $pageOuter = $( '#qodef-page-outer' ),
					$header    = $( '#qodef-page-header' );

				fixedHeaderAppearance.showHideHeader( $pageOuter, $header );

				$( window ).scroll(
					function () {
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);

				$( window ).resize(
					function () {
						$pageOuter.css( 'padding-top', '0' );
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);
			}
		}
	};

	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	var stickyHeaderAppearance = {
		header: '',
		docYScroll: 0,
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			// Set variables.
			stickyHeaderAppearance.header 	  = $( '.qodef-header-sticky' );
			stickyHeaderAppearance.docYScroll = $( document ).scrollTop();

			// Set sticky visibility.
			stickyHeaderAppearance.setVisibility( displayAmount );

			$( window ).scroll(
				function () {
					stickyHeaderAppearance.setVisibility( displayAmount );
				}
			);
		},
		displayAmount: function () {
			if ( qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0 ) {
				return parseInt( qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10 );
			} else {
				var $elementorSectionBeforeHeader      = $( '.qodef-elementor-section-before-header' );
				var elementorSectionBeforeHeaderHeight = $elementorSectionBeforeHeader.length ? $elementorSectionBeforeHeader.height() : 0;

				return parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight + elementorSectionBeforeHeaderHeight, 10 );
			}
		},
		setVisibility: function ( displayAmount ) {
			var isStickyHidden = qodefCore.scroll < displayAmount;

			if ( stickyHeaderAppearance.header.hasClass( 'qodef-appearance--up' ) ) {
				var currentDocYScroll = $( document ).scrollTop();

				isStickyHidden = (currentDocYScroll > stickyHeaderAppearance.docYScroll && currentDocYScroll > displayAmount) || (currentDocYScroll < displayAmount);

				stickyHeaderAppearance.docYScroll = $( document ).scrollTop();
			}

			stickyHeaderAppearance.showHideHeader( isStickyHidden );
		},
		showHideHeader: function ( isStickyHidden ) {
			if ( isStickyHidden ) {
				qodefCore.body.removeClass( 'qodef-header--sticky-display' );
			} else {
				qodefCore.body.addClass( 'qodef-header--sticky-display' );
			}
		},
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchCoversHeader.init();
		}
	);

	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' );

			if ( $searchOpener.length ) {
				$searchOpener.each(
					function () {
						var $searchForm  = $( this ).closest( '.qodef-header-sticky, #qodef-page-header' ).find( '.qodef-search-cover-form' ),
							$searchClose = $searchForm.find( '.qodef-m-close' );

						if ( $searchForm.length ) {
							$( this ).on(
								'click',
								function ( e ) {
									e.preventDefault();
									qodefSearchCoversHeader.openCoversHeader( $searchForm );
								}
							);
							$searchClose.on(
								'click',
								function ( e ) {
									e.preventDefault();
									qodefSearchCoversHeader.closeCoversHeader( $searchForm );
								}
							);
						}
					}
				);
			}
		},
		openCoversHeader: function ( $searchForm ) {
			qodefCore.body.addClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).focus();
				},
				600
			);
		},
		closeCoversHeader: function ( $searchForm ) {
			qodefCore.body.removeClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.addClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).val( '' );
					$searchForm.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );
				},
				300
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearch.init();
		}
	);

	var qodefSearch = {
		init: function () {
			this.search = $( 'a.qodef-search-opener' );

			if ( this.search.length ) {
				this.search.each(
					function () {
						var $thisSearch = $( this );

						qodefSearch.searchHoverColor( $thisSearch );
					}
				);
			}
		},
		searchHoverColor: function ( $searchHolder ) {
			if ( typeof $searchHolder.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $searchHolder.data( 'hover-color' ),
					originalColor = $searchHolder.css( 'color' );

				$searchHolder.on(
					'mouseenter',
					function () {
						$searchHolder.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$searchHolder.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'qode_essential_addons_portfolio_list';

	qodefCore.shortcodes[shortcode]                      = {};
	qodefCore.shortcodes[shortcode].qodefSwiper          = qodefCore.qodefSwiper;
	qodefCore.shortcodes[shortcode].qodefFsLightboxPopup = qodefCore.qodefFsLightboxPopup;
	qodefCore.shortcodes[shortcode].qodefMasonryLayout   = qodefCore.qodefMasonryLayout;

	$( document ).ready(
		function () {
			qodefFloatingPortfolio.init();
		}
	);

	var qodefFloatingPortfolio = {
		init: function () {
			var $holder = $( '.qodef-item-layout--info-follow' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						qodefFloatingPortfolio.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $thisHolder ) {
			if ( $thisHolder.hasClass( 'qodef-item-layout--info-follow' ) ) {
				qodefCore.qodefInfoFollow.init( $thisHolder );
			}
		}
	};

	qodefCore.shortcodes[shortcode].qodefFloatingPortfolio = qodefFloatingPortfolio;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'qode_essential_addons_product_list';

	qodefCore.shortcodes[shortcode]                      = {};
	qodefCore.shortcodes[shortcode].qodefSwiper          = qodefCore.qodefSwiper;
	qodefCore.shortcodes[shortcode].qodefFsLightboxPopup = qodefCore.qodefFsLightboxPopup;
	qodefCore.shortcodes[shortcode].qodefMasonryLayout   = qodefCore.qodefMasonryLayout;

})( jQuery );
