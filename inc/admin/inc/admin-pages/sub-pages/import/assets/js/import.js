(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefLazyImages.init();
			qodefDemos.init();
			qodefImport.init();
			qodefInitSingleDemo.init();
			qodefInitSingleDemo.closeDemo();
			qodefInstallPlugin.init();
			qodefSwiper.init();
			qodefSelect2.init();
			qodefReloadDemos.init();
		}
	);

	$( window ).scroll(
		function () {
			qodefLazyImages.init();
		}
	);

	var qodefDemos = {
		qsRegex: '',
		init: function () {
			var $demosList = $( '.qodef-import-demos-inner' );

			if ( $demosList.length ) {
				$demosList.each(
					function () {
						var $thisDemoList       = $( this ),
							$masonry            = $thisDemoList.find( '.qodef-grid-inner' ),
							$masonryItemSizeGap = parseInt( $masonry.css( 'column-gap' ) ),
							$quickSearch;

						var $masonryIsotope = $masonry.isotope(
							{
								layoutMode: 'packery',
								itemSelector: '.qodef-import-demo',
								percentPosition: true,
								packery: {
									columnWidth: '.qodef-import-demos-grid-sizer',
									gutter: $masonryItemSizeGap,
								}
							}
						);

						$masonryIsotope.on(
							'layoutComplete',
							function () {
								qodefLazyImages.init();
							}
						);

						qodefDemos.updateCountFiltered( $thisDemoList.find( '.qodef-grid-inner' ) );

						$quickSearch = $thisDemoList.find( '.qodef-filter-holder-top .quicksearch' )

						qodefDemos.initFilter(
							$thisDemoList,
							$quickSearch
						);

						qodefDemos.searchItems(
							$thisDemoList,
							$quickSearch
						);

					}
				);
			}
		},
		initFilter: function ( $thisDemoList, $quickSearch ) {
			$thisDemoList.find( '.qodef-filter-item' ).click(
				function ( event, isActiveFilter ) {
					var $thisFilter      = $( this ),
						$filterItems,
						filterItemsValue = '';

					// reset value in quick search input.
					$quickSearch.val( '' );
					$( '.qodef-no-demos' ).remove();

					$thisFilter.parent().find( '.qodef-filter-item' ).removeClass( 'qodef-demos-current' );
					if ( ! isActiveFilter ) {
						$thisFilter.addClass( 'qodef-demos-current' );
					}

					$( 'html, body' ).animate(
						{ scrollTop: 0 },
						400,
						'swing'
					).promise().then(
						function () {
							// Called when the animation in total is complete, since callback is called twice, both for body and html.
							$filterItems = $thisDemoList.find( '.qodef-demos-current' );

							$filterItems.each(
								function () {
									filterItemsValue += $( this ).data( 'filter' );
								}
							);

							$thisDemoList.find( '.qodef-grid-inner' ).isotope( { filter: filterItemsValue } );

							qodefDemos.updateCountFiltered( $thisDemoList.find( '.qodef-grid-inner' ) );
						}
					);
				}
			);
		},
		updateCountFiltered: function ($holder) {
			var count = $holder.data( 'isotope' ).filteredItems.length,
				text  = 'demos.';

			if (count <= 1) {
				text = 'demo.';
			}

			// if there is no demos, write a message.
			$( '.qodef-no-demos' ).remove();
			if ( count == 0 ) {
				$( '<div class="qodef-no-demos"><h3>No demos found. Try another term.</h3></div>' ).insertBefore( $holder );
			}

			// show count of demos found.
			$holder.parent().find( '.qodef-filter-number-of-results' ).html( 'Choose from <span>' + count + ' ' + text + '</span>' );

		},
		searchItems: function ($thisDemoList, $quickSearch) {
			// this has to be before 'keyup events' since autocomplete is preventing them.
			$quickSearch.easyAutocomplete(
				{
					data: qodefAdminImport.vars.demosSearchPredictions,
					list: {
						maxNumberOfElements: 10,
						match: {
							enabled: true
						},
						onChooseEvent: function () {
							qodefDemos.searchFilter(
								$thisDemoList,
								$quickSearch
							);
						},
						onShowListEvent: function () {
							$quickSearch.addClass( 'qodef-show-list' );
						},
						onHideListEvent: function () {
							$quickSearch.removeClass( 'qodef-show-list' );
						}

					}
				}
			);

			// use value of search field to filter.
			$quickSearch.keyup(
				this.debounce(
					function () {
						qodefDemos.searchFilter(
							$thisDemoList,
							$quickSearch
						);
					},
					500
				)
			);

		},
		debounce: function (fn, threshold) {
			var timeout;
			return function debounced() {
				if (timeout) {
					clearTimeout( timeout );
				}
				function delayed() {
					fn();
					timeout = null;
				}

				timeout = setTimeout(
					delayed,
					threshold || 100
				);
			}
		},
		searchFilter: function ( $thisDemoList, $quickSearch ) {
			// remove active filter classes.
			$thisDemoList.find( '.qodef-filter-item' ).removeClass( 'qodef-demos-current' );

			qodefDemos.qsRegex = new RegExp(
				$quickSearch.val(),
				'gi'
			);

			$thisDemoList.find( '.qodef-grid-inner' ).isotope(
				{
					filter: function () {
						return qodefDemos.qsRegex ? $( this ).text().match( qodefDemos.qsRegex ) : true;
					}
				}
			);
			qodefDemos.updateCountFiltered(
				$thisDemoList.find( '.qodef-grid-inner' )
			);
		}
	}

	var qodefLazyImages = {
		init: function () {

			$( '.qodef-lazy-load img:not(.qodef-lazy-loading)' ).each(
				function ( i, object ) {

					object = $( object );

					var rect = object[0].getBoundingClientRect(),
						vh   = (qodefFramework.windowHeight || document.documentElement.clientHeight),
						vw   = (qodefFramework.windowWidth || document.documentElement.clientWidth),
						oh   = object.outerHeight(),
						ow   = object.outerWidth();

					if (
						(rect.top != 0 || rect.right != 0 || rect.bottom != 0 || rect.left != 0) &&
						(rect.top >= 0 || rect.top + oh >= 0) &&
						(rect.bottom >= 0 && rect.bottom - oh - vh <= 500) &&
						(rect.left >= 0 || rect.left + ow >= 0) &&
						(rect.right >= 0 && rect.right - ow - vw <= 0)
					) {
						object.addClass( 'qodef-lazy-loading' );

						var imageObj = new Image();

						$( imageObj ).on(
							'load',
							function () {
								var $this = $( this );
								object.attr(
									'src',
									$this.attr( 'src' )
								);
								object
								.removeAttr( 'data-image' )
								.removeData( 'image' )
								.removeClass( 'qodef-lazy-loading' );
								object.parent().removeClass( 'qodef-lazy-load' );
							}
						).attr(
							'src',
							object.data( 'image' )
						);
					}
				}
			);
		}
	};

	var qodefSwiper = {
		init: function () {
			var $swiperContainer = $( '.qodef-swiper-container' )[0];
			var $mainSwiper = new Swiper(
				$swiperContainer,
				{
					slidesPerView: 1,
					effect: 'fade',
					fadeEffect: {
						crossFade: true
					},
					loop: true,
					autoHeight: true,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					on: {
						slideChange: function () {
							// $mainSwiper is not defined if loop is true, becase 'slideChage' is called on int.
							// $mainSwiper.slides.length - 2, 2 is here beacuse there are duplicates due to loop: true and slidesPreview: 1.
							if ( typeof $mainSwiper !== 'undefined' ) {
								$( '.qodef-swiper-container .swiper-counter span' ).html( ($mainSwiper.realIndex + 1) + '/' + ( $mainSwiper.slides.length - 2 ) );
							}
						},
					},
				}
			);
		}
	};

	var qodefImport = {
		importDemo: '',
		importAction: '',
		importImages: 0,
		attachmentBlocks: 0,
		attachmentCounter: 0,
		totalPercent: 0,
		numberOfRequests: 1,
		nextStep: '',
		stepPercent: 0,
		init: function () {
			qodefImport.holder = $( '.qodef-import-form' );

			if ( qodefImport.holder.length ) {
				qodefImport.holder.each(
					function () {
						var qodefImportBtn         = $( '#qodef-import-demo-data' ),
							importAction           = $( '.qodef-import-option' ),
							importDemoElement      = $( '.qodef-import-form .qodef-import-demo' ),
							confirmMessage         = qodefImport.holder.data( 'confirm-message' ),
							emptyImportTypeMessage = qodefImport.holder.data( 'empty-import-type-message' );

						qodefImportBtn.on(
							'click',
							function ( e ) {
								e.preventDefault();
								qodefImport.reset();
								qodefImport.importImages = $( '.qodef-import-attachments' ).is( ':checked' ) ? 1 : 0;
								qodefImport.importDemo   = importDemoElement.val();
								qodefImport.importAction = importAction.val();

								if ( qodefImport.importAction === 'none' ) {
									alert( emptyImportTypeMessage );
									return;
								}

								if ( confirm( confirmMessage ) ) {
									$( '.qodef-form-section-progress' ).show();
									$( this ).addClass( 'qodef-import-demo-data-disabled' );
									$( this ).attr(
										'disabled',
										true
									);
									qodefImport.initImportType( qodefImport.importAction );
								}
							}
						);
					}
				);
			}
		},

		initImportType: function ( action ) {
			switch (action) {
				case 'widgets':
					qodefImport.numberOfRequests = 1;
					qodefImport.countStep();
					qodefImport.importWidgets();
					break;
				case 'options':
					qodefImport.numberOfRequests = 1;
					qodefImport.countStep();
					qodefImport.importOptions();
					break;
				case 'content':
					qodefImport.nextStep = 'terms';
					qodefImport.importContent();
					break;
				case 'complete':
					qodefImport.nextStep = 'terms';
					qodefImport.importAll();
					break;
			}
		},

		countStep: function () {
			qodefImport.stepPercent = ( 100 / qodefImport.numberOfRequests);

		},
		setNumberOfRequests: function () {
			/**
			 * 1 - for posts, terms is not included because number is set after terms imported
			 */
			qodefImport.numberOfRequests += 1 + qodefImport.attachmentBlocks;
			if ( 'complete' === qodefImport.importAction ) {
				qodefImport.numberOfRequests += qodefImport.holder.data( 'other-files' );
			}
			qodefImport.countStep();
		},
		importWidgets: function () {
			var data = {
				action: 'widgets',
				demo: qodefImport.importDemo
			};
			qodefImport.importAjax( data );
		},

		importOptions: function () {
			var data = {
				action: 'options',
				demo: qodefImport.importDemo
			};
			qodefImport.importAjax( data );
		},

		importSettingsPages: function () {
			var data = {
				action: 'settings-page',
				demo: qodefImport.importDemo
			};
			qodefImport.importAjax( data );
		},

		importMenuSettings: function () {
			var data = {
				action: 'menu-settings',
				demo: qodefImport.importDemo
			};
			qodefImport.importAjax( data );
		},

		importContent: function () {

			if ( 'terms' === qodefImport.nextStep ) {
				qodefImport.importTerms();
			}
			if ( 'attachments' === qodefImport.nextStep ) {
				qodefImport.importAttachments();
			}
			if ( 'posts' === qodefImport.nextStep ) {
				qodefImport.importPosts();
			}
		},

		importAll: function () {

			switch (qodefImport.nextStep) {
				case 'widgets':
					qodefImport.importWidgets();
					break;
				case 'options':
					qodefImport.importOptions();
					break;
				case 'settings-pages':
					qodefImport.importSettingsPages();
					break;
				case 'menu-settings':
					qodefImport.importMenuSettings();
					break;
				default:
					qodefImport.importContent();
			}
		},
		importTerms: function () {
			var data = {
				action: 'content',
				contentType: 'terms'
			};

			qodefImport.importAjax( data );

		},
		importPosts: function () {
			var data = {
				action: 'content',
				contentType: 'posts'
			};
			qodefImport.importAjax( data );
		},

		importAttachment: function () {
			var data = {
				action: 'content',
				contentType: 'attachments',
				attachmentNumber: 1
			};
			qodefImport.importAjax( data );
		},

		importAttachments: function () {

			for ( var i = 1; i <= qodefImport.attachmentBlocks; i++ ) {
				var data = {
					action: 'content',
					contentType: 'attachments',
					attachmentNumber: i,
					images: qodefImport.importImages
				};
				qodefImport.importAjax( data );
			}
		},

		importAjax: function ( options ) {

			var defaults = {
				demo: qodefImport.importDemo,
				nonce: $( '#qodef_import_nonce' ).val()
			};
			$.extend(
				defaults,
				options
			);

			$.ajax(
				{
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'import_action',
						options: defaults
					},
					success: function ( data ) {
						var response = JSON.parse( data );
						qodefImport.ajaxSuccess(
							response,
							options
						);
					},
					error: function ( data ) {
						var response = JSON.parse( data );
						qodefImport.ajaxError(
							response,
							options
						);
					}
				}
			);
		},
		importProgress: function () {
			qodefImport.totalPercent += qodefImport.stepPercent;

			if ( 100 < qodefImport.totalPercent ) {
				qodefImport.totalPercent = 100;
			}

			$( '#qodef-progress-bar' ).val( Math.round( qodefImport.totalPercent ) );
			$( '.qodef-progress-percent' ).html( Math.round( qodefImport.totalPercent ) + '%' );

			if ( 100 === Math.round( qodefImport.totalPercent ) ) {
				$( '#qodef-import-demo-data' ).remove( '.qodef-import-demo-data-disabled' );
				$( '.qodef-import-is-completed' ).show();
			}
		},
		ajaxSuccess: function ( response, options ) {

			if ( typeof response.status !== 'undefined' && response.status === 'success' ) {
				if ( options.action === 'content' ) {

					switch (options.contentType) {
						case 'terms':
							qodefImport.proccedTermsResponse( response );
							break;
						case 'attachments':
							qodefImport.proccedAttachmentsResponse( response );
							break;
						case 'posts':
							qodefImport.proccedPostsResponse( response );
							break;
					}
				} else if ( 'complete' === qodefImport.importAction ) {

					switch (options.action) {
						case 'options':
							qodefImport.nextStep = 'widgets';
							qodefImport.importAll();
							break;
						case 'widgets':
							qodefImport.nextStep = 'menu-settings';
							qodefImport.importAll();
							break;
						case 'menu-settings':
							qodefImport.nextStep = 'settings-pages';
							qodefImport.importAll();
							break;
						case 'settings-pages':
							qodefImport.nextStep = '';
							break;
					}

				}

				qodefImport.importProgress();
			} else {
				qodefImport.holder.find( '#qodef-import-demo-data' ).remove( '.qodef-import-demo-data-disabled' );
				qodefImport.holder.find( '.qodef-import-went-wrong' ).show();
			}
		},

		ajaxError: function ( response, options ) {
			console.log( 'error' );
			console.log( response );
		},

		proccedTermsResponse: function ( response ) {

			if ( typeof response.data.number_of_blocks !== 'undefined' ) {
				qodefImport.attachmentBlocks = response.data.number_of_blocks;
				qodefImport.nextStep         = 'attachments';

				qodefImport.setNumberOfRequests();
			}
			qodefImport.importContent();
		},
		proccedAttachmentsResponse: function ( response ) {
			if ( typeof response.data.attachment_block !== 'undefined' ) {
				qodefImport.attachmentCounter++;
			}

			if ( qodefImport.attachmentCounter === qodefImport.attachmentBlocks ) {
				qodefImport.nextStep = 'posts';
				qodefImport.importContent();
			}
		},
		proccedPostsResponse: function () {

			if ( 'complete' === qodefImport.importAction ) {
				qodefImport.nextStep = 'options';
				qodefImport.importAll();
			}
		},
		reset: function () {
			qodefImport.totalPercent = 0;
			$( '#qodef-progress-bar' ).val( 0 );
		}
	};

	var qodefInitSingleDemo = {
		mainURL: '',
		singleHolder: '',
		contentHolder: '',
		init: function () {
			var $container              = $( '.qodef-import-demos-inner' ),
				$demoImportLinks        = $container.find( '.qodef-import-demo-link' ),
				$demoUpgradeLinks       = $container.find( '.qodef-upgrade-link' ),
				$demoUpgradeHolder      = $( '.qodef-demo-upgrade' ),
				$demoUpgradeHolderClose = $demoUpgradeHolder.find( '.qodef-demo-upgrade-message-close' ),
				nonceHolder             = $container.find( '#qode_essential_addons_demo_import_nonce' );

			qodefInitSingleDemo.mainURL       = qodefInitSingleDemo.clearURL( window.location.href );
			qodefInitSingleDemo.singleHolder  = $( '.qodef-demo-single' );
			qodefInitSingleDemo.contentHolder = $( '.qodef-admin-demos-content ' );

			$demoImportLinks.on(
				'click',
				function ( e ) {
					e.preventDefault();
					var $demo = $( this ),
						$demoID;

					if ( typeof $demo.data( 'demo-id' ) !== 'undefined' && $demo.data( 'demo-id' ) !== '' ) {
						$demoID = $demo.data( 'demo-id' );
					}

					$.ajax(
						{
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'open_demo_single',
								demoId: $demoID,
								nonce: nonceHolder.val()
							},
							success: function ( data ) {
								var response = JSON.parse( data );
								qodefInitSingleDemo.openDemo(
									response.data,
									$demoID
								);

								var adminHeaderHeight = $( '.qodef-admin-header.qodef-fixed' ).length ? $( '.qodef-admin-header.qodef-fixed' ).outerHeight() : 0;

								$( window ).scrollTop( $( '.qodef-admin-page-v4' ).offset().top - adminHeaderHeight - $( '#wpadminbar' ).outerHeight() );
								qodefInitSingleDemo.closeDemo();
								qodefImport.init();
								qodefInstallPlugin.init();
								qodefSwiper.init();
								qodefSelect2.init();
							},
						}
					);
				}
			);

			$demoUpgradeLinks.on(
				'click',
				function ( e ) {
					e.preventDefault();
					$demoUpgradeHolder.addClass( 'show' );
					$( this ).closest( 'article' ).addClass( 'hovered' );
				}
			);

			$demoUpgradeHolderClose.on(
				'click',
				function () {
					$demoUpgradeHolder.removeClass( 'show' );
					$container.find( 'article' ).removeClass( 'hovered' );
				}
			);
		},
		changeURL: function ( $url ) {
			history.pushState(
				'',
				'',
				$url
			);
		},
		addParamsToURL: function ( $params ) {
			var $query             = { 'demo-id': $params },
				$currentUrl        = qodefInitSingleDemo.mainURL,
				$urlParamSeparator = (window.location.href.indexOf( '?' ) === -1) ? '?' : '&',
				$newUrl            = $currentUrl + $urlParamSeparator + decodeURIComponent( $.param( $query ) );
			qodefInitSingleDemo.changeURL( $newUrl );
		},
		removeParamsFromURL: function () {

			var $url = window.location.href;

			var $cleanURL = qodefInitSingleDemo.clearURL( $url );
			qodefInitSingleDemo.changeURL( $cleanURL );

		},
		clearURL: function ( $url ) {

			var $parameter = 'demo-id';

			var $urlParts = $url.split( '?' );
			if ( $urlParts.length >= 2 ) {

				var $prefix = encodeURIComponent( $parameter ) + '=';
				var $pars   = $urlParts[1].split( /[&;]/g );

				// reverse iteration as may be destructive.
				for ( var i = $pars.length; i-- > 0; ) {
					// idiom for string.startsWith.
					if ( $pars[i].lastIndexOf(
						$prefix,
						0
					) !== -1 ) {
						$pars.splice(
							i,
							1
						);
					}
				}

				return $urlParts[0] + ($pars.length > 0 ? '?' + $pars.join( '&' ) : '');
			}

			return $url;
		},
		openDemo: function ( data, $demoID ) {
			qodefInitSingleDemo.contentHolder.addClass( 'qodef-demo-import-single-opened' );
			qodefInitSingleDemo.singleHolder.html( data );
			qodefInitSingleDemo.addParamsToURL( $demoID );
		},
		closeDemo: function ( data ) {
			var $closeButton = $( '.qodef-return-to-demo-list' );

			if ( $closeButton.length ) {
				$closeButton.on(
					'click',
					function ( e ) {
						e.preventDefault();

						qodefInitSingleDemo.contentHolder.removeClass( 'qodef-demo-import-single-opened' );
						qodefInitSingleDemo.singleHolder.html();
						qodefInitSingleDemo.removeParamsFromURL();
						qodefDemos.init();
					}
				);
			}
		}
	};

	var qodefInstallPlugin = {
		init: function () {
			$( '.qodef-required-plugins-holder' ).on(
				'click',
				'.qodef-install-plugin-link',
				function ( e ) {
					e.preventDefault();

					var $link              = $( this ),
						$allLinks          = $link.parents( '.qodef-required-plugins-holder' ).find( '.qodef-install-plugin-link' ),
						$pluginAction      = 'install',
						$pluginActionLabel = '',
						$pluginSlug        = '',
						$nonce             = '';

					$allLinks.addClass( 'qodef-disabled' );
					$link.removeClass( 'qodef-disabled' );
					$link.next( '.qodef-plugin-installing-spinner' ).addClass( 'active' );
					$nonce = $link.parents( '.qodef-required-plugins-holder' ).find( '#qode_essential_addons_plugin_install_nonce' );

					if ( typeof $link.data( 'plugin-action' ) !== 'undefined' && $link.data( 'plugin-action' ) !== '' ) {
						$pluginAction = $link.data( 'plugin-action' );
					}

					if ( typeof $link.data( 'plugin-action-label' ) !== 'undefined' && $link.data( 'plugin-action-label' ) !== '' ) {
						$pluginActionLabel = $link.data( 'plugin-action-label' );
					}

					if ( typeof $link.data( 'plugin-slug' ) !== 'undefined' && $link.data( 'plugin-slug' ) !== '' ) {
						$pluginSlug = $link.data( 'plugin-slug' );
					}

					$link.text( $pluginActionLabel );

					jQuery.ajax(
						{
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'install_plugin',
								pluginAction: $pluginAction,
								pluginSlug: $pluginSlug,
								nonce: $nonce.val()
							},
							success: function ( data ) {
								var $response = JSON.parse( data );

								if ( $pluginAction === 'install' ) {
									if ( $response.status === 'success' ) {
										$link.next( '.qodef-plugin-installing-spinner' ).removeClass( 'active' );
										$link.text( $response.message );
										$link.data(
											'plugin-action',
											'activate'
										);
										$link.data(
											'plugin-action-label',
											$response.data.action_label
										);
									}
								} else {
									if ( $response.status === 'success' ) {
										$link.next( '.qodef-plugin-installing-spinner' ).removeClass( 'active' );
										$link.addClass( 'qodef-disabled' );
										$link.text( $response.message );
										$link.attr(
											'data-plugin-action',
											'activated'
										);
									}
								}

								$allLinks.removeClass( 'qodef-disabled' );
							},
							error: function () {

							}
						}
					);
					return false;
				}
			);
		}
	};

	var qodefSelect2 = {
		init: function () {
			this.$holder = $( 'select.qodef-select2' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						qodefSelect2.initField( $( this ) );
					}
				);
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( 'select.qodef-select2' );

			if ( $holder.length ) {
				qodefSelect2.initField( $holder );
			}
		},
		initField: function ( thisHolder ) {
			if ( typeof thisHolder.select2 === 'function' ) {
				thisHolder.select2(
					{
						width: '100%',
						allowClear: false,
						minimumResultsForSearch: 11,
						dropdownCssClass: 'qodef-select-v4',
					}
				);
			}
		}
	};

	let qodefReloadDemos = {
		init: function () {
			qodefReloadDemos.holder = $( '.qodef-import-demos' );

			if ( qodefReloadDemos.holder.length ) {
				qodefReloadDemos.holder.each(
					function () {
						let thisHolder      = $( this ),
							trigger         = thisHolder.find( '.qodef-import-top-reload-button' ),
							nonceHolder     = thisHolder.find( '#qode_essential_addons_reload_demo_import' ),
							listInnerHolder = thisHolder.find( '.qodef-import-demos-inner' );

						if ( trigger.length && nonceHolder.length ) {
							trigger.on(
								'click',
								function( e ) {
									e.preventDefault();

									$.ajax(
										{
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'qode_essential_addons_reload_demo_import',
												nonce: nonceHolder.val()
											},
											success: function ( data ) {
												let response = JSON.parse( data );

												if ( 'success' === response.status ) {
													listInnerHolder.html( response.data );
													qodefLazyImages.init();
													qodefDemos.init();
													qodefInitSingleDemo.init();
												}
											}
										}
									);
								}
							)
						}
					}
				)
			}
		}
	};

})( jQuery );
