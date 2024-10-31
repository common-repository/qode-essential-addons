(function ( $ ) {
	'use strict';

	if ( typeof qodefFramework !== 'object' ) {
		window.qodefFramework = {};
	}

	qodefFramework.scroll       = 0;
	qodefFramework.windowWidth  = $( window ).width();
	qodefFramework.windowHeight = $( window ).height();

	$( document ).ready(
		function () {
			var $mainHolder      = $( '.qodef-page-v4-essential-addons' ),
				$adminPageHolder = $( '.qodef-admin-page-v4' );

			if ( $mainHolder.length ) {
				qodefAdminOptionsPanel.init();

				qodefInitMediaUploader.init( $mainHolder );
				qodefColorPicker.init( $mainHolder );
				qodefDatePicker.init( $mainHolder );
				qodefSelect2.init( $mainHolder );
				qodefInitIconPicker.init( $mainHolder );

				qodefPostFormatsDependency.init();

				if ( $adminPageHolder.length ) {
					qodefSearchOptions.init( $adminPageHolder );
				}

				qodefAddressFields.init( $mainHolder );

				qodefReinitRepeaterFields.init();
			}
		}
	);

	$( window ).load(
		function () {
			qodefPostFormatsDependency.init( true );
		}
	);

	$( window ).scroll(
		function () {
			qodefFramework.scroll = $( window ).scrollTop();
		}
	);

	$( window ).resize(
		function () {
			qodefFramework.windowWidth  = $( window ).width();
			qodefFramework.windowHeight = $( window ).height();

			if ( qodefFramework.windowWidth > 600 &&
				typeof qodefAdminOptionsPanel.adminPage !== 'undefined' &&
				qodefAdminOptionsPanel.adminPage.length &&
				typeof qodefAdminOptionsPanel.adminHeader !== 'undefined' &&
				qodefAdminOptionsPanel.adminHeader.length ) {
				qodefAdminOptionsPanel.adminHeader.css(
					'width',
					qodefAdminOptionsPanel.adminPage.width()
				);
			}
		}
	);

	var qodefReinitRepeaterFields = {
		init: function () {
			$( document ).on(
				'qodef_add_new_row_trigger',
				function ( event, $row ) {
					if ( typeof qodefSearchOptions.fieldHolder !== 'undefined' ) {
						qodefSearchOptions.fieldHolder.push( $row );
					}
					qodefInitMediaUploader.reinit( $row );
					qodefColorPicker.reinit( $row );
					qodefDatePicker.reinit( $row );
					qodefSelect2.reinit( $row );
					qodefInitIconPicker.reinit( $row );
				}
			);
		}
	};

	var qodefAdminOptionsPanel = {
		init: function () {
			this.adminPage = $( '.qodef-admin-page-v4' );

			if ( this.adminPage.length ) {
				this.adminHeight( this.adminPage );
				this.adminHeaderPosition();
				this.navigationInit();
				this.saveOptionsInit( this.adminPage );
				this.setActivePanel();
				this.navigationReset();

				if ( qodefFramework.windowWidth <= 800 ) {
					this.mobile( this.adminPage );
				}
			}
		},
		mobile: function ( $admin ) {
			var $opener          = $admin.find( '.qodef-mobile-nav-opener' ),
				$navigation      = $admin.find( '.qodef-tabs-navigation-wrapper' ),
				$navigationInner = $admin.find( '.qodef-tabs-navigation-wrapper-inner' );

			qodefFramework.qodefPerfectScrollbar.init( $navigationInner );

			$opener.on(
				'click tap',
				function ( e ) {
					e.preventDefault();

					if ( $navigation.hasClass( 'qodef--show' ) ) {
						$navigation.removeClass( 'qodef--show' );
						qodefAdminScroll.enable();
					} else {
						$navigation.addClass( 'qodef--show' );
						qodefAdminScroll.disable();
					}
				}
			);

			$( document ).on(
				'click',
				function ( e ) {

					if ( ! $( e.target ).closest( '.qodef-tabs-navigation-wrapper, .qodef-mobile-nav-opener' ).length ) {
						if ( $navigation.hasClass( 'qodef--show' ) ) {
							$navigation.removeClass( 'qodef--show' );
							qodefAdminScroll.enable();
						}
					}
				}
			);

		},
		adminHeight: function ( $holder ) {
			var $adminContent    = $holder.find( '.qodef-admin-content' ),
				$adminNavigation = $holder.find( '.qodef-tabs-navigation-wrapper' );

			$adminContent.css( 'min-height', $adminNavigation.height() );
		},
		navigationReset: function () {
			var urlParams = new URLSearchParams( window.location.search );
			var template  = urlParams.get( 'template' );

			if ( template !== null ) {
				this.adminPage.find( '.qodef-tabs-navigation-wrapper .navbar ul li' ).removeClass( 'qodef-active' );
			}
		},
		navigationInit: function () {
			var navigationItems = this.adminPage.find( '.qodef-tabs-navigation-wrapper .navbar ul li' );

			navigationItems.on(
				'click',
				function () {
					qodefSearchOptions.resetSearchView();
					qodefSearchOptions.resetSearchField();
					qodefAdminOptionsPanel.initTabNavItemClick( $( this ) );
					qodefAdminOptionsPanel.initNavItemClick( $( this ), true );
				}
			);
		},
		initTabNavItemClick: function ( item ) {
			var panelName = item.find( '.nav-link' ).data( 'section' );
			var urlParams = new URLSearchParams( window.location.search );
			var template  = urlParams.get( 'template' );

			if ( template !== null ) {
				this.setCookie(
					'qodefActiveTab',
					panelName
				);
				window.location = item.data( 'options-url' );

			}
		},
		initNavItemClick: function ( item, click_trigger ) {
			if ( item.length ) {
				var panelName = item.find( '.nav-link' ).data( 'section' );

				if ( item.hasClass( 'qodef-layout-custom' ) && ! item.hasClass( 'qodef-active' ) && click_trigger && item.data( 'options-url' ) ) {
					this.setCookie(
						'qodefActiveTab',
						panelName
					);

					window.location = item.data( 'options-url' );
					return;
				}

				var $navigationPanes = this.adminPage.find( '.qodef-tabs-content' );
				var $activePane      = $navigationPanes.find( '.tab-content:visible' );
				$activePane.addClass( 'qodef-hide-pane' );

				var $newPane = $navigationPanes.find( '.tab-content[data-section=' + panelName + ']' );
				$newPane.removeClass( 'qodef-hide-pane' );

				item.siblings( '.qodef-active' ).removeClass( 'qodef-active' );
				item.addClass( 'qodef-active' );
				this.setCookie(
					'qodefActiveTab',
					panelName
				);

				setTimeout(
					function () {
						qodefFramework.qodefColorPicker.checkFieldPosition( $newPane );

						$( document.body ).on(
							'qodef_trigger_tab_change',
							function () {
								qodefFramework.qodefColorPicker.checkFieldPosition( $newPane );
							}
						);
					},
					500
				);
			}
		},
		setActivePanel: function () {
			var cookie = this.getCookie( 'qodefActiveTab' );

			if ( cookie !== '' && cookie !== 'undefined') {
				this.initNavItemClick( $( '.qodef-tabs-navigation-wrapper .nav-link[data-section=' + cookie + ']' ).parent() );
			} else {
				this.initNavItemClick( $( '.qodef-tabs-navigation-wrapper .navbar ul li:first-child' ) );
			}
		},
		saveOptionsInit: function ( $adminPage ) {
			this.optionsForm = this.adminPage.find( '#qode_essential_addons_framework_ajax_form' );

			var buttonPressed,
				$saveResetLoader = $( '.qodef-save-reset-loading' ),
				$saveSuccess     = $( '.qodef-save-success' );

			if ( this.optionsForm.length ) {
				$( '.qodef-save-reset-button' ).on(
					'click',
					function () {
						buttonPressed = $( this ).attr( 'name' );
					}
				);

				this.optionsForm.on(
					'submit',
					function ( e ) {
						e.preventDefault();
						e.stopPropagation();
						$saveResetLoader.addClass( 'qodef-show-loader' );
						$adminPage.addClass( 'qodef-save-reset-disable' );

						var form          = $( this ),
							button_action = buttonPressed === 'qodef_save' ? 'qode_essential_addons_action_framework_save_options_' : 'qode_essential_addons_action_framework_reset_options_',
							ajaxData      = {
								action: button_action + form.data( 'options-name' ),
								options_name: form.data( 'options-name' )
						};

						var $formFields      = form.find( '[class*=qodef-page-v4]:not(.qodef-exclude-panel-from-saving) :input' );
						var $formNonceFields = form.find( ' > :input' );

						if ( form.siblings( ':input' ).length ) {
							$formNonceFields = form.siblings( ':input' );
						}

						$.ajax(
							{
								type: 'POST',
								url: ajaxurl,
								cache: ! 1,
								data: $.param( ajaxData, ! 0 ) + '&' + $formFields.serialize() + '&' + $formNonceFields.serialize(),
								success: function () {
									$saveResetLoader.removeClass( 'qodef-show-loader' );

									switch (buttonPressed) {
										case 'qodef_reset':
											window.location.reload( true );
											break;
										case 'qodef_save':
											$adminPage.removeClass( 'qodef-save-reset-disable' );
											$saveSuccess.fadeIn( 300 );

											setTimeout(
												function () {
													$saveSuccess.fadeOut( 200 );
												},
												2000
											);
											break;
									}
								}
							}
						);
					}
				);
			}
		},
		setCookie: function ( name, value ) {
			document.cookie = name + '=' + value;
		},
		getCookie: function ( name ) {
			var newName          = name + '=';
			var decodedCookie    = decodeURIComponent( document.cookie );
			var cookieArray      = decodedCookie.split( ';' );
			var cookieArrayCount = cookieArray.length;

			for ( var i = 0; i < cookieArrayCount; i++ ) {
				var cookie = cookieArray[i];

				while (cookie.charAt( 0 ) === ' ') {
					cookie = cookie.substring( 1 );
				}

				if ( cookie.indexOf( newName ) === 0 ) {
					return cookie.substring(
						newName.length,
						cookie.length
					);
				}
			}
			return '';
		},
		adminHeaderPosition: function () {
			this.adminPage 	 = $( '.qodef-admin-page-v4' );
			this.adminHeader = $( '.qodef-admin-header' );

			if ( this.adminPage.length && this.adminHeader.length && qodefFramework.windowWidth > 600 ) {
				this.adminBarHeight         = $( '#wpadminbar' ).height();
				this.adminHeaderHeight      = this.adminHeader.outerHeight( true );
				this.adminHeaderTopPosition = this.adminHeader.offset().top - parseInt( this.adminBarHeight );
				this.adminContent           = $( '.qodef-admin-content' );
				this.adminNavigation        = $( '.qodef-tabs-navigation-wrapper' );
				this.adminNavigationInner   = $( '.qodef-tabs-navigation-wrapper-inner' );

				this.adminHeader.css( 'width', this.adminPage.width() );

				$( window ).on(
					'scroll load',
					function () {
						if ( qodefFramework.scroll >= qodefAdminOptionsPanel.adminHeaderTopPosition ) {
							qodefAdminOptionsPanel.adminHeader.addClass( 'qodef-fixed' ).css(
								'top',
								parseInt( qodefAdminOptionsPanel.adminBarHeight )
							);
							qodefAdminOptionsPanel.adminContent.css(
								'marginTop',
								qodefAdminOptionsPanel.adminHeaderHeight
							);
							if ( qodefFramework.windowWidth <= 800 ) {
								qodefAdminOptionsPanel.adminNavigation.css(
									'marginTop',
									qodefAdminOptionsPanel.adminBarHeight + qodefAdminOptionsPanel.adminHeaderHeight
								);
							}
						} else {
							qodefAdminOptionsPanel.adminHeader.removeClass( 'qodef-fixed' ).css(
								'top',
								0
							);
							qodefAdminOptionsPanel.adminContent.css(
								'marginTop',
								0
							);
							if ( qodefFramework.windowWidth <= 800 ) {
								qodefAdminOptionsPanel.adminNavigation.css(
									'marginTop',
									qodefAdminOptionsPanel.adminHeader.offset().top + qodefAdminOptionsPanel.adminHeaderHeight - qodefFramework.scroll
								);
							}
						}
					}
				);
			}
		},
	};

	var qodefInitMediaUploader = {
		init: function ( $mainHolder ) {
			this.$holder = $mainHolder.find( '.qodef-image-uploader' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						qodefInitMediaUploader.initField( $( this ) );
					}
				);
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( '.qodef-image-uploader' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						qodefInitMediaUploader.initField( $( this ) );
					}
				);
			}
		},
		initField: function ( thisHolder ) {
			var variables = {
				$multiple: thisHolder.data( 'multiple' ) === 'yes' && thisHolder.data( 'file' ) === 'no',
				$file: thisHolder.data( 'file' ) === 'yes',
				$allowed_type: thisHolder.data( 'file' ) === 'yes' ? thisHolder.data( 'allowed-type' ) : 'image',
				$imageHolder: thisHolder,
				mediaFrame: '',
				attachment: '',
				$thumbImageHolder: thisHolder.find( '.qodef-image-thumb' ),
				$uploadId: thisHolder.find( '.qodef-image-upload-id' ),
				$removeButton: thisHolder.find( '.qodef-image-remove-btn' )
			};

			if ( variables.$thumbImageHolder.find( 'img' ).length ) {
				variables.$removeButton.show();
				qodefInitMediaUploader.remove( variables.$removeButton );
			}

			qodefInitMediaUploader.reset( thisHolder );

			variables.$imageHolder.on(
				'click',
				'.qodef-image-upload-btn',
				function () {

					// if the media frame already exists, reopen it.
					if ( variables.mediaFrame ) {
						variables.mediaFrame.open();
						return;
					}

					// create the media frame.
					variables.mediaFrame = wp.media.frames.fileFrame = wp.media(
						{
							title: $( this ).data( 'frame-title' ),
							button: {
								text: $( this ).data( 'frame-button-text' )
							},
							library: {
								type: variables.$allowed_type
							},
							multiple: variables.$multiple
						}
					);

					// call right select, multiple or single or file.
					if ( variables.$file ) {
						qodefInitMediaUploader.fileSelect( variables );
					} else if ( variables.$multiple ) {
						qodefInitMediaUploader.multipleSelect( variables );
					} else {
						qodefInitMediaUploader.singleSelect( variables );
					}

					// check selected images when wp media is opened.
					variables.mediaFrame.on(
						'open',
						function () {
							var selection = variables.mediaFrame.state().get( 'selection' ),
								ids       = variables.$uploadId.val().split( ',' );
							ids.forEach(
								function ( id ) {
									variables.attachment = wp.media.attachment( id );
									variables.attachment.fetch();
									selection.add( variables.attachment ? [variables.attachment] : [] );
								}
							);
						}
					);

					// open media frame.
					variables.mediaFrame.open();
				}
			);
		},
		multipleSelect: function ( variables ) {
			variables.mediaFrame.on(
				'select',
				function () {
					variables.attachment = variables.mediaFrame.state().get( 'selection' ).map(
						function ( attachment ) {
							attachment.toJSON();
							return attachment;
						}
					);

					variables.$removeButton.show().trigger( 'change' );
					qodefInitMediaUploader.remove( variables.$removeButton );

					var ids = $.map(
						variables.attachment,
						function ( o ) {
							if ( o.attributes.type === 'image' ) {
								return o.id;
							}
						}
					);

					variables.$uploadId.val( ids );
					variables.$thumbImageHolder.find( 'ul' ).empty().trigger( 'change' );

					// loop through the array and add image for each attachment.
					var attachment_count = variables.attachment.length;

					for ( var i = 0; i < attachment_count; ++i ) {
						if ( variables.attachment[i].attributes.sizes !== undefined ) {
							if ( variables.attachment[i].attributes.sizes.thumbnail !== undefined ) {
								variables.$thumbImageHolder.find( 'ul' ).append( '<li><img src="' + variables.attachment[i].attributes.sizes.thumbnail.url + '" alt="thumbnail" /></li>' );
							} else {
								variables.$thumbImageHolder.find( 'ul' ).append( '<li><img src="' + variables.attachment[i].attributes.sizes.full.url + '" alt="thumbnail" /></li>' );
							}
						}
					}

					variables.$thumbImageHolder.show().trigger( 'change' );
				}
			);
		},
		singleSelect: function ( variables ) {
			variables.mediaFrame.on(
				'select',
				function () {
					variables.attachment = variables.mediaFrame.state().get( 'selection' ).first().toJSON();

					// write to url field and img tag.
					if ( variables.attachment.hasOwnProperty( 'url' ) && variables.attachment.type === 'image' ) {

						variables.$removeButton.show();
						qodefInitMediaUploader.remove( variables.$removeButton );

						variables.$uploadId.val( variables.attachment.id );
						variables.$thumbImageHolder.empty();

						if ( variables.attachment.hasOwnProperty( 'sizes' ) && variables.attachment.sizes.thumbnail ) {
							variables.$thumbImageHolder.append( '<img class="qodef-single-image" src="' + variables.attachment.sizes.thumbnail.url + '" alt="thumbnail" />' );
						} else {
							variables.$thumbImageHolder.append( '<img class="qodef-single-image" src="' + variables.attachment.url + '" alt="thumbnail" />' );
						}
						variables.$thumbImageHolder.show().trigger( 'change' );
					}

				}
			);
		},
		fileSelect: function ( variables ) {

			variables.mediaFrame.on(
				'select',
				function () {
					variables.attachment = variables.mediaFrame.state().get( 'selection' ).first().toJSON();

					// write to url field and img tag.
					if ( variables.attachment.hasOwnProperty( 'url' ) && variables.$allowed_type.includes( variables.attachment.type ) ) {

						variables.$removeButton.show();
						qodefInitMediaUploader.remove( variables.$removeButton );

						variables.$uploadId.val( variables.attachment.id );
						variables.$thumbImageHolder.empty();

						variables.$thumbImageHolder.append(
							'' +
							'<img class="qodef-file-image" src="' + variables.attachment.icon + '" alt="thumbnail" />' +
							'<div class="qodef-file-name">' + variables.attachment.filename + '</div>' +
							''
						);

						variables.$thumbImageHolder.show().trigger( 'change' );
					}

				}
			);
		},
		remove: function ( button ) {
			button.on(
				'click',
				function () {
					// Remove images and hide it's holder.
					button.siblings( '.qodef-image-thumb' ).hide();
					button.siblings( '.qodef-image-thumb' ).find( 'img' ).attr(
						'src',
						''
					);
					button.siblings( '.qodef-image-thumb' ).find( 'li' ).remove();

					// reset meta fields.
					button.siblings( '.qodef-image-meta-fields' ).find( 'input[type="hidden"]' ).each(
						function () {
							$( this ).val( '' );
						}
					);

					button.hide().trigger( 'change' );
				}
			);
		},
		reset: function ( thisHolder ) {
			$( document ).on(
				'ajaxSuccess',
				function ( event, xhr, options ) {

					if ( -1 === options.data.indexOf( 'action=add-tag' ) ) {
						return;
					}

					thisHolder.find( '.qodef-image-thumb' ).hide();
					thisHolder.find( '.qodef-image-thumb' ).find( 'img' ).attr(
						'src',
						''
					);
					thisHolder.find( '.qodef-image-thumb' ).find( 'li' ).remove();

					// reset meta fields.
					thisHolder.find( '.qodef-image-meta-fields' ).find( 'input[type="hidden"]' ).each(
						function () {
							$( this ).val( '' );
						}
					);
				}
			);
		}
	};

	var qodefColorPicker = {
		init: function ( $mainHolder ) {
			this.$holder = $mainHolder.find( '.qodef-color-field:not(.widefat)' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						qodefColorPicker.initField( $( this ) );
					}
				);
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( '.qodef-color-field:not(.widefat)' );

			if ( $holder.length ) {
				qodefColorPicker.initField( $holder );
			}
		},
		initField: function ( thisHolder ) {
			thisHolder.wpColorPicker(
				{
					palettes: false,
					mode    : 'hsl',
				}
			);
		},
		checkFieldPosition: function ( item ) {
			var holder = item.find( '.qodef-color-field:not(.widefat)' );

			if ( holder.length ) {
				holder.each(
					function () {
						var thisHolder   = $( this ).parents( '.qodef-field-content' );
						var adminContent = $( '#wpbody-content' );

						if ( adminContent.length && (adminContent.outerHeight() - thisHolder.offset().top < 340) ) {
							thisHolder.addClass( 'qodef-color-picker-reverse' );
						}
					}
				);
			}
		}
	};

	qodefFramework.qodefColorPicker = qodefColorPicker;

	var qodefDatePicker = {
		init: function ( $mainHolder ) {
			this.$holder = $mainHolder.find( '.qodef-datepicker' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						qodefDatePicker.initField( $( this ) );
					}
				);
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( '.qodef-datepicker' );

			if ( $holder.length ) {
				qodefDatePicker.initField( $holder );
			}
		},
		initField: function ( thisHolder ) {
			var dateFormat = thisHolder.data( 'date-format' );
			thisHolder.datepicker( { dateFormat: dateFormat } );
		}
	};

	var qodefSelect2 = {
		init: function ( $mainHolder ) {
			this.$holder = $mainHolder.find( 'select.qodef-select2' );

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

	qodefFramework.select2 = qodefSelect2;

	var qodefInitIconPicker = {
		init: function ( $mainHolder ) {
			this.$holder = $mainHolder.find( '.qodef-iconpicker-select:not(.qodef-select2):not(.qodef--icons-init)' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						var $thisHolder = $( this );

						if ( typeof $thisHolder.fontIconPicker === 'function' ) {
							$thisHolder.addClass( 'qodef--icons-init' );
							$thisHolder.fontIconPicker();
						}
					}
				);
			}
		},
		reinit: function ( row, $element ) {
			var $holder = typeof $element !== 'undefined' && $element !== '' && $element !== false ? $element : $( row ).find( '.qodef-iconpicker-select:not(.qodef-select2)' );

			if ( $holder.length && ! $holder.hasClass( 'qodef--icons-init' ) && typeof $holder.fontIconPicker === 'function' ) {
				$holder.addClass( 'qodef--icons-init' );
				$holder.fontIconPicker();
			}
		}
	};

	var qodefPostFormatsDependency = {
		init: function ( onLoad ) {
			if ( onLoad ) {
				qodefPostFormatsDependency.initObserver();
				qodefPostFormatsDependency.gutenbergEditor();
			} else {
				qodefPostFormatsDependency.classicEditor();
			}
		},
		initObserver: function () {
			var $holder = $( '.edit-post-sidebar' );

			if ( $holder.length ) {
				var mutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

				// create mutation observer prototype for class changes.
				$.fn.attrChange = function ( attrChangeCallback ) {
					if ( mutationObserver ) {
						var options = {
							attributes: true,
							attributeFilter: ['class'],
							subtree: false,
						};

						var observer = new mutationObserver(
							function ( mutations ) {
								mutations.forEach(
									function ( event ) {
										attrChangeCallback.call( event.target );
									}
								);
							}
						);

						return this.each(
							function () {
								observer.observe(
									this,
									options
								);
							}
						);
					}
				};

				// append event listener.
				$holder.find( '.edit-post-sidebar__panel-tabs ul li:first-child button' ).attrChange(
					function () {
						if ( $( this ).hasClass( 'is-active' ) ) {
							qodefPostFormatsDependency.gutenbergEditor();
						}
					}
				);
			}
		},
		classicEditor: function () {
			var $holder          = $( '#post-formats-select' ),
				$postFormats     = $holder.find( 'input[name="post_format"]' ),
				$selectedFormat  = $holder.find( 'input[name="post_format"]:checked' ),
				selectedFormatID = $selectedFormat.attr( 'id' );

			// This is temporary case - waiting ui style.
			$postFormats.each(
				function () {
					qodefPostFormatsDependency.metaBoxVisibility(
						false,
						$( this ).attr( 'id' )
					);
				}
			);

			qodefPostFormatsDependency.metaBoxVisibility(
				true,
				selectedFormatID
			);

			$postFormats.change(
				function () {
					qodefPostFormatsDependency.classicEditor();
				}
			);
		},
		gutenbergEditor: function () {
			var $holder = $( '.edit-post-sidebar' );

			if ( $holder.length ) {
				var $postFormats    = $holder.find( '.editor-post-format' ),
					$selectedFormat = $postFormats.find( 'select option:selected' );

				$postFormats.find( 'select option' ).each(
					function () {
						qodefPostFormatsDependency.metaBoxVisibility(
							false,
							'post_format_' + $( this ).val()
						);
					}
				);

				if ( $selectedFormat.length ) {
					qodefPostFormatsDependency.metaBoxVisibility(
						true,
						'post_format_' + $selectedFormat.val()
					);
				}

				$postFormats.find( 'select' ).one(
					'change',
					function () {
						qodefPostFormatsDependency.gutenbergEditor();
					}
				);
			}
		},
		metaBoxVisibility: function ( visibility, itemID ) {
			if ( itemID !== '' && itemID !== undefined ) {
				var postFormatName = itemID.replace(
					/-/g,
					'_'
				);

				if ( visibility ) {
					$( '.qodef-section-name-qodef_' + postFormatName + '_section' ).fadeIn();
				} else {
					$( '.qodef-section-name-qodef_' + postFormatName + '_section' ).hide();
				}
			}
		}
	};

	var qodefAddressFields = {
		init: function ( $mainHolder, trigger ) {
			this.$addressHolder = $mainHolder.find( '.qodef-address-field-holder' );

			if ( this.$addressHolder.length ) {
				this.$addressHolder.each(
					function () {
						qodefAddressFields.initMap(
							$( this ),
							trigger
						);
					}
				);
			}
		},
		initMap: function ( $holder, trigger ) {
			var $reset       = $holder.find( '.qodef-reset-marker' ),
				$inputField  = $holder.find( 'input' ),
				$mapField    = $holder.find( '.qodef-map-canvas' ),
				countryLimit = $holder.data( 'country' ),
				latFieldName = $holder.data( 'lat' ),
				$latField    = $( '.qodef-address-elements [name="' + latFieldName + '"]' ),
				lngFieldName = $holder.data( 'lng' ),
				$lngField    = $( '.qodef-address-elements [name="' + lngFieldName + '"]' );

			// This peace of code is required in order to re init maps for address field type when it's inside tabs layout.
			if ( trigger ) {
				$inputField.trigger( 'geocode' );
			}

			if ( typeof $inputField.geocomplete === 'function' && typeof trigger === 'undefined' ) {
				$inputField.geocomplete(
					{
						map: $mapField,
						details: '.qodef-address-elements',
						detailsAttribute: 'data-geo',
						types: ['geocode', 'establishment'],
						country: countryLimit,
						markerOptions: {
							draggable: true
						},
					}
				).bind(
					'geocode:result',
					function () {
						$reset.show();
					}
				);

				$inputField.on(
					'geocode:dragged',
					function ( event, latLng ) {
						$latField.val( latLng.lat() );
						$lngField.val( latLng.lng() );
						$reset.show();
						var map = $inputField.geocomplete( 'map' );
						map.panTo( latLng );
						var geocoder = new google.maps.Geocoder();

						geocoder.geocode(
							{ 'latLng': latLng },
							function ( results, status ) {
								if ( status === google.maps.GeocoderStatus.OK && typeof results[0] === 'object' ) {
									$inputField.val( results[0].formatted_address );
								}
							}
						);
					}
				);

				$inputField.on(
					'focus',
					function () {
						var map = $inputField.geocomplete( 'map' );
						google.maps.event.trigger(
							map,
							'resize'
						);
					}
				);

				$reset.on(
					'click',
					function ( e ) {
						e.preventDefault();

						$reset.hide();

						$inputField.geocomplete( 'resetMarker' ).val( '' );
						$latField.val( '' );
						$lngField.val( '' );
					}
				);

				$( window ).on(
					'load',
					function () {
						$inputField.trigger( 'geocode' );
					}
				);
			}
		},
	};

	qodefFramework.qodefAddressFields = qodefAddressFields;

	var qodefSearchOptions = {
		init: function ( $adminPageHolder ) {
			this.searchField    = $adminPageHolder.find( '.qodef-search-field' );
			this.adminContent   = $adminPageHolder.find( '.qodef-admin-content' );
			this.tabHolder      = $adminPageHolder.find( '.tab-content' );
			this.rowHolder      = $adminPageHolder.find( '.qodef-row-wrapper' );
			this.sectionHolder  = $adminPageHolder.find( '.qodef-section-wrapper' );
			this.repeaterHolder = $adminPageHolder.find( '.qodef-repeater-wrapper' );
			this.fieldHolder    = $adminPageHolder.find( '.qodef-field-holder' );

			if ( this.searchField.length ) {
				var searchLoading = this.searchField.next( '.qodef-search-loading' ),
					searchRegex,
					keyPressTimeout;

				this.searchField.on(
					'keyup paste',
					function () {
						var field = $( this );
						field.attr(
							'autocomplete',
							'off'
						);
						searchLoading.removeClass( 'qodef-hidden' );
						clearTimeout( keyPressTimeout );

						keyPressTimeout = setTimeout(
							function () {
								var searchTerm = field.val();
								searchRegex    = new RegExp(
									field.val(),
									'gi'
								);
								searchLoading.addClass( 'qodef-hidden' );

								if ( searchTerm.length < 3 ) {
									qodefSearchOptions.resetSearchView();
								} else {
									qodefSearchOptions.resetSearchView();
									qodefSearchOptions.adminContent.addClass( 'qodef-apply-search' );
									qodefSearchOptions.fieldHolder.each(
										function () {
											var thisFieldHolder = $( this );
											if ( thisFieldHolder.find( '.qodef-field-desc' ).text().search( searchRegex ) !== -1 ) {
												thisFieldHolder.parents( '.tab-content' ).addClass( 'qodef-search-show' );
												thisFieldHolder.parents( '.qodef-section-wrapper' ).addClass( 'qodef-search-show' );
												thisFieldHolder.parents( '.qodef-row-wrapper' ).addClass( 'qodef-search-show' );
												thisFieldHolder.parents( '.qodef-repeater-wrapper' ).addClass( 'qodef-search-show' );
											} else {
												thisFieldHolder.addClass( 'qodef-search-hide' );
											}
										}
									);
								}
							},
							500
						);
					}
				);

			}
		},
		resetSearchView: function () {
			this.adminContent.removeClass( 'qodef-apply-search' );
			this.tabHolder.removeClass( 'qodef-search-show' );
			this.rowHolder.removeClass( 'qodef-search-show' );
			this.sectionHolder.removeClass( 'qodef-search-show' );
			this.repeaterHolder.removeClass( 'qodef-search-show' );
			this.fieldHolder.removeClass( 'qodef-search-hide' );

		},
		resetSearchField: function () {
			this.searchField.val( '' );
		}
	};

	var qodefAdminScroll = {
		disable: function () {
			if ( window.addEventListener ) {
				window.addEventListener(
					'wheel',
					qodefAdminScroll.preventDefaultValue,
					{ passive: false }
				);
				window.addEventListener(
					'touchmove',
					qodefAdminScroll.preventDefaultValue,
					{ passive: false }
				);
			}

			document.onkeydown = qodefAdminScroll.keyDown;
		},
		enable: function () {
			if ( window.removeEventListener ) {
				window.removeEventListener(
					'wheel',
					qodefAdminScroll.preventDefaultValue,
					{ passive: false }
				);
				window.removeEventListener(
					'touchmove',
					qodefAdminScroll.preventDefaultValue,
					{ passive: false }
				);
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function ( e ) {
			e = e || window.event;
			if ( e.preventDefault ) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function ( e ) {
			var keys = [37, 38, 39, 40];
			for ( var i = keys.length; i--; ) {
				if ( e.keyCode === keys[i] ) {
					qodefAdminScroll.preventDefaultValue( e );
					return;
				}
			}
		}
	};

})( jQuery );
