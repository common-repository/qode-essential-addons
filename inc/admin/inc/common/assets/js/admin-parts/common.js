(function ( $ ) {
	'use strict';

	if ( typeof qodefFramework !== 'object' ) {
		window.qodefFramework = {};
	}

	$( document ).ready(
		function () {
			var $mainHolder = $( '.qodef-page-v4-essential-addons' );

			if ( $mainHolder.length ) {
				qodefTabs.init( $mainHolder );
				qodefDependency.init( $mainHolder );
				qodefRepeater.init( $mainHolder );
			}
		}
	);

	var qodefTabs = {
		init: function ( $mainHolder ) {
			this.holder = $mainHolder.filter( '.qodef-tab-wrapper' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTabs.initTabs(
							$mainHolder,
							$( this )
						);
						var $tabsWrapper = $( this ).find( '.qodef-tab-item-nav-wrapper' );
						qodefFramework.qodefPerfectScrollbar.init( $tabsWrapper, false );
						qodefTabs.initTabsDrag( $tabsWrapper );


					}
				);
			}
		},
		initTabs: function ( $mainHolder, tabs ) {
			tabs.children( '.qodef-tab-item-content' ).each(
				function ( index ) {
					index = index + 1;

					var $that    = $( this ),
						link     = $that.attr( 'id' ),
						$navItem = $that.parent().find( '.qodef-tab-item-nav-wrapper li:nth-child(' + index + ') a' ),
						navLink  = $navItem.attr( 'href' );

					link = '#' + link;

					if ( link.indexOf( navLink ) > -1 ) {
						$navItem.attr(
							'href',
							link
						);
					}
				}
			);

			tabs.addClass( 'qodef--init' ).tabs(
				{
					activate: function () {
						// This peace of code is required in order to re init maps for address field type when it's inside tabs layout.
						if ( typeof qodefFramework.qodefAddressFields === 'object' ) {
							qodefFramework.qodefAddressFields.init( $mainHolder, true );
						}

						$( document.body ).trigger( 'qodef_trigger_tab_change' );
					}
				}
			);
		},
		initTabsDrag: function ( $tabsWrapper ) {
			var isDown = false;
			var startX;
			var scrollLeft;

			$tabsWrapper.on(
				'mousewheel',
				(event, delta) => {
					$tabsWrapper[0].scrollLeft -= (delta * 20);
					$tabsWrapper[0].scrollRight -= (delta * 20);
					event.preventDefault();
				}
			);

			$tabsWrapper.on(
				'mousedown',
				(e) => {
					e.preventDefault();
					isDown     = true;
					$tabsWrapper.addClass( 'qodef-drag' );
					startX     = e.pageX - $tabsWrapper[0].offsetLeft;
					scrollLeft = $tabsWrapper[0].scrollLeft;
				}
			);
			$tabsWrapper.on(
				'mouseleave',
				() => {
					isDown = false;
					$tabsWrapper.removeClass( 'qodef-drag' );
				}
			);
			$tabsWrapper.on(
				'mouseup',
				() => {
					isDown = false;
					$tabsWrapper.removeClass( 'qodef-drag' );
				}
			);
			$tabsWrapper.on(
				'mousemove',
				( e ) => {
					if ( ! isDown ) return;
					e.preventDefault();
					var x                = e.pageX - $tabsWrapper[0].offsetLeft;
					var walk             = (x - startX) ;
					$tabsWrapper[0].scrollLeft = scrollLeft - walk;
				}
			);
		}
	};

	var qodefDependency = {
		init: function ( $mainHolder ) {
			qodefDependency.initOptions( $mainHolder );
			qodefDependency.initMenu();
			qodefDependency.initWidget();
			qodefDependency.initProductAttributeTypeSelectBox();
		},
		initOptions: function ( $mainHolder ) {
			var $dependencyOptions = $mainHolder.find( '.qodef-field-content .qodef-field[data-option-name]' );
			if ( $dependencyOptions.length ) {
				qodefDependency.initFields( $dependencyOptions );
			}
		},
		initMenu: function () {
			var $dependencyOptions = $( '#update-nav-menu .qodef-menu-item-field[data-option-name]' );

			if ( $dependencyOptions.length ) {
				qodefDependency.initFields( $dependencyOptions );
			}
		},
		initWidget: function () {
			var $dependencyOptions = $( '.widget-content .qodef-widget-field[data-option-name]' );
			if ( $dependencyOptions.length ) {
				$dependencyOptions.each(
					function () {
						var $option = $( this );

						if ( $option.parents( '#widget-list' ).length <= 0 ) {
							qodefDependency.initField( $option );
						}
					}
				);
			}
		},
		reinitRepeater: function ( $mainHolder ) {
			var $dependencyOptions = $mainHolder.find( '.qodef-repeater-fields-holder .qodef-field-content .qodef-field[data-option-name]' );

			if ( $dependencyOptions.length ) {
				$dependencyOptions.each(
					function () {
						var $thisOption    = $( this );
						var thisOptionType = $thisOption.data( 'option-type' );

						switch (thisOptionType) {
							case 'selectbox':
								qodefDependency.qodefSelectBoxDependencyRepeater( $thisOption );
								break;
							case 'radiogroup':
								qodefDependency.qodefRadioGroupDependencyRepeater( $thisOption );
								break;
						}
						qodefDependency.initField( $thisOption );
					}
				);
			}
		},
		reinitWidget: function ( widgetDependencyFields ) {
			qodefDependency.initFields( widgetDependencyFields );
		},
		initFields: function ( fields ) {
			fields.each(
				function () {
					var $thisOption = $( this );

					if ( $thisOption.parents( '.qodef-repeater-template' ).length <= 0 ) {
						qodefDependency.initField( $thisOption );
					}
				}
			);
		},
		initField: function ( thisOption ) {
			var thisOptionType = thisOption.data( 'option-type' );

			if ( ! thisOption.hasClass( 'qodef-dependency-option' ) ) {
				thisOption.addClass( 'qodef-dependency-option' );

				switch (thisOptionType) {
					case 'selectbox':
						qodefDependency.qodefSelectBoxDependency( thisOption );
						break;
					case 'radiogroup':
						qodefDependency.qodefRadioGroupDependency( thisOption );
						break;
					case 'yesno':
						qodefDependency.qodefRadioGroupDependency( thisOption );
						break;
					case 'checkbox':
						qodefDependency.qodefCheckBoxDependency( thisOption );
						break;
				}
			}
		},
		qodefSelectBoxDependency: function ( option ) {
			option.on(
				'change',
				function () {
					var optionValue = $( this ).val();

					qodefDependency.qodefDependencyActionInit( option, optionValue );
				}
			);
			option.trigger( 'change' );
		},
		qodefSelectBoxDependencyRepeater: function ( option ) {
			var repeaterOptionValue = option.val();

			qodefDependency.qodefDependencyActionInit( option, repeaterOptionValue );
		},
		qodefRadioGroupDependency: function ( option ) {
			var optionName = option.data( 'option-name' ),
				radioItem  = option.find( 'input[name="' + optionName + '"]' );

			radioItem.on(
				'change',
				function () {
					var optionValue = this.value;

					qodefDependency.qodefDependencyActionInit( option, optionValue );
				}
			);
			qodefDependency.qodefDependencyActionInit(
				option,
				option.find( 'input[name="' + option.data( 'option-name' ) + '"]:checked' ).val()
			);
		},
		qodefRadioGroupDependencyRepeater: function ( option ) {
			var optionName          = option.data( 'option-name' ),
				radioItem           = option.find( 'input[name="' + optionName + '"]' ),
				repeaterOptionValue = radioItem.value;
			qodefDependency.qodefDependencyActionInit(
				option,
				repeaterOptionValue
			);
		},
		qodefCheckBoxDependency: function ( option ) {
			option.on(
				'click',
				function () {
					var $thisOption = $( this );
					var optionValue = $thisOption.val();

					if ( $thisOption.is( ':checked' ) ) {
						optionValue += '-checked';
					}

					qodefDependency.qodefDependencyActionInit(
						option,
						optionValue
					);
				}
			);
		},
		qodefDependencyActionInit: function ( option, optionValue ) {
			var dependencyHolder = $( '.qodef-dependency-holder' ),
				optionName       = option.data( 'option-name' );

			if ( option.prop( 'id' ) === 'attribute_type' ) {
				optionName = option.attr( 'name' );
			}

			if ( dependencyHolder.length && optionName !== undefined && optionName !== '' && optionValue !== undefined ) {
				dependencyHolder.each(
					function () {
						var $thisHolder     = $( this ),
							showDataItems   = $thisHolder.data( 'show' ),
							hideDataItems   = $thisHolder.data( 'hide' ),
							relationData    = $thisHolder.data( 'relation' ),
							relation        = 'and',
							dependencyItems = '',
							visibility      = true;

						if ( showDataItems !== '' && showDataItems !== undefined ) {
							dependencyItems = showDataItems;
						}

						if ( hideDataItems !== '' && hideDataItems !== undefined ) {
							dependencyItems = hideDataItems;
							visibility      = false;
						}

						if ( relationData !== '' && relationData !== undefined ) {
							relation = relationData;
						}

						if ( '' !== dependencyItems ) {

							if ( qodefDependency.qodefGetNumberOfItems( dependencyItems ) > 1 ) {
								qodefDependency.qodefMultipleDependencyLogic(
									dependencyItems,
									$thisHolder,
									optionName,
									optionValue,
									visibility,
									relation
								);
							} else {
								qodefDependency.qodefSingleDependencyLogic(
									dependencyItems,
									$thisHolder,
									optionName,
									optionValue,
									visibility
								);
							}
						}
					}
				);
			}
		},
		qodefGetNumberOfItems: function ( items ) {
			var numberOfItems = 0;

			for ( var item in items ) {
				if ( items.hasOwnProperty( item ) ) {
					++numberOfItems;
				}
			}

			return numberOfItems;
		},
		qodefMultipleDependencyLogic: function ( dataItems, holder, optionName, optionValue, show, relation ) {
			var flag           = [],
				itemVisibility = true;

			$.each(
				dataItems,
				function ( key, value ) {
					value = value.split( ',' );

					if ( optionName === key ) {
						if ( value.indexOf( optionValue ) !== -1 ) {
							flag.push( true );
						} else {
							flag.push( false );
						}
					} else {
						var otherOptionName = $( '.qodef-dependency-option[data-option-name="' + key + '"]' ),
							otherOptionType = otherOptionName.data( 'option-type' ),
							otherValue      = '';

						// if there is no field with key in data-option-name, try to find it as checked field.
						if ( 0 === otherOptionName.length ) {
							var checkedFlag  = [],
								checkedValue = false;

							otherOptionName = $( '.qodef-dependency-option[data-option-name^="' + key + '["]' );
							otherOptionType = otherOptionName.data( 'option-type' );

							if ( otherOptionName.length && 'checkbox' === otherOptionType ) {
								otherOptionName.each(
									function () {
										var checked = $( this ).is( ':checked' );

										if ( checked ) {
											otherValue = $( this ).val();

											if ( otherValue.length && value.indexOf( otherValue ) !== -1 ) {
												checkedFlag.push( true );
											} else {
												checkedFlag.push( false );
											}
										}

									}
								);

								for ( var f in checkedFlag ) {
									if ( checkedFlag[f] ) {
										checkedValue = true;
									}
								}
								flag.push( checkedValue );
							}
						} else {
							switch (otherOptionType) {
								case 'selectbox':
									otherValue = otherOptionName.val();
									break;
								case 'radiogroup':
									otherValue = otherOptionName.find( 'input[name="' + key + '"]:checked' ).val();
									break;
							}

							if ( otherValue.length && value.indexOf( otherValue ) !== -1 ) {
								flag.push( true );
							} else {
								flag.push( false );
							}
						}
					}
				}
			);

			if ( 'and' === relation ) {
				for ( var f in flag ) {
					if ( ! flag[f] ) {
						itemVisibility = false;
					}
				}
			} else {
				itemVisibility = false;
				for ( var f in flag ) {
					if ( flag[f] ) {
						itemVisibility = true;
						continue;
					}
				}
			}

			if ( show ) {
				if ( itemVisibility ) {
					holder.fadeIn( 200 );
				} else {
					holder.fadeOut( 200 );
				}
			} else {
				if ( itemVisibility ) {
					holder.fadeOut( 200 );
				} else {
					holder.fadeIn( 200 );
				}
			}
		},
		qodefSingleDependencyLogic: function ( dataItems, holder, optionName, optionValue, show ) {
			$.each(
				dataItems,
				function ( key, value ) {
					var checkBoxValue = typeof optionValue === 'string' ? optionValue.replace( '-checked', '' ) : '';

					if ( optionName === key ) {
						value = value.split( ',' );

						if ( show ) {
							if ( value.indexOf( optionValue ) !== -1 ) {
								holder.removeClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.addClass( 'qodef-show-dependency-holder' );
							} else {
								holder.addClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.removeClass( 'qodef-show-dependency-holder' );
							}
						} else {
							if ( value.indexOf( optionValue ) !== -1 ) {
								holder.addClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.removeClass( 'qodef-show-dependency-holder' );
							} else {
								holder.removeClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.addClass( 'qodef-show-dependency-holder' );
							}
						}
					} else if ( optionName === key + '[' + checkBoxValue + ']' && checkBoxValue === value ) {

						if ( show ) {
							if ( value.indexOf( checkBoxValue ) !== -1 && optionValue.indexOf( '-checked' ) !== -1 ) {
								holder.removeClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.addClass( 'qodef-show-dependency-holder' );
							} else {
								holder.addClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.removeClass( 'qodef-show-dependency-holder' );
							}
						} else {
							if ( value.indexOf( checkBoxValue ) !== -1 && optionValue.indexOf( '-checked' ) !== -1 ) {
								holder.addClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.removeClass( 'qodef-show-dependency-holder' );
							} else {
								holder.removeClass( 'qodef-hide-dependency-holder' );

								// For search options manipulation.
								holder.addClass( 'qodef-show-dependency-holder' );
							}
						}
					}
				}
			);
		},
		initProductAttributeTypeSelectBox: function () {
			var thisOption = $( '#attribute_type' );

			if ( thisOption.length ) {
				qodefDependency.qodefSelectBoxDependency( thisOption );
			}
		},
	};

	qodefFramework.qodefDependency = qodefDependency;

	var qodefRepeater = {
		init: function ( $mainHolder ) {
			qodefRepeater.initRepeater( $mainHolder );
			qodefRepeater.initRepeaterInner( $mainHolder );
		},
		initRepeater: function ( $mainHolder ) {
			var repeaterHolder = $mainHolder.find( '.qodef-repeater-wrapper' );

			if ( repeaterHolder.length ) {
				repeaterHolder.each(
					function () {
						var $thisHolder = $( this );

						qodefRepeater.qodefAddNewRow( $thisHolder, $mainHolder );
						qodefRepeater.qodefRemoveRow( $thisHolder );
						qodefRepeater.qodefInitSortable( $thisHolder );
					}
				);
			}
		},
		initRepeaterInner: function ( $mainHolder ) {
			var repeaterInnerHolder = $mainHolder.find( '.qodef-repeater-inner-wrapper' );

			if ( repeaterInnerHolder.length ) {
				repeaterInnerHolder.each(
					function () {
						var $thisHolder = $( this );

						qodefRepeater.qodefAddNewRowInner( $thisHolder, $mainHolder );
						qodefRepeater.qodefRemoveRowInner( $thisHolder );
						qodefRepeater.qodefInitSortableInner( $thisHolder );
					}
				);
			}
		},
		qodefGetNumberOfRows: function ( holder ) {
			return holder.find( '.qodef-repeater-fields-holder' ).length;
		},
		qodefInitSortable: function ( holder ) {
			if ( holder.find( '.qodef-repeater-wrapper-main.sortable' ).length ) {
				$( '.qodef-repeater-wrapper-main.sortable' ).sortable(
					{
						placeholder: 'qodef-placeholder',
						forcePlaceholderSize: true,
						handle: '.qodef-repeater-sort'
					}
				);
			}
			qodefRepeater.qodefInitSortableInner( holder );
		},
		qodefInitSortableInner: function ( holder ) {
			if ( holder.find( '.qodef-repeater-inner-wrapper-main.sortable' ).length ) {
				$( '.qodef-repeater-inner-wrapper-main.sortable' ).sortable(
					{
						placeholder: 'qodef-placeholder',
						forcePlaceholderSize: true,
						handle: '.qodef-repeater-inner-sort'
					}
				);
			}
		},
		qodefAddNewRow: function ( holder, $mainHolder ) {
			var $addButton       = holder.find( '.qodef-repeater-add a' );
			var templateName     = holder.find( '.qodef-repeater-wrapper-main' ).data( 'template' );
			var $repeaterContent = holder.find( '.qodef-repeater-wrapper-main' );
			var repeaterTemplate = wp.template( 'qodef-repeater-template-' + templateName );

			$addButton.off().on(
				'tap click',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					var $row = $(
						repeaterTemplate(
							{
								rowIndex: qodefRepeater.qodefGetNumberOfRows( holder ) || 0
							}
						)
					);

					$repeaterContent.append( $row );
					var innerHolder = $row.find( '.qodef-repeater-inner-wrapper' );
					qodefRepeater.qodefAddNewRowInner(
						innerHolder,
						$mainHolder
					);
					qodefRepeater.qodefRemoveRowInner( innerHolder );
					qodefRepeater.qodefInitSortable( holder );
					qodefDependency.reinitRepeater( $mainHolder );

					$( document ).trigger(
						'qodef_add_new_row_trigger',
						$row.find( '.qodef-repeater-fields' )
					);
				}
			);
		},
		qodefRemoveRow: function ( holder ) {
			var repeaterContent = holder.find( '.qodef-repeater-wrapper-main' );

			repeaterContent.off().on(
				'click',
				'.qodef-clone-remove',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					if ( ! window.confirm( 'Are you sure you want to remove this section?' ) ) {
						return;
					}

					var $rowParent = $( this ).parents( '.qodef-repeater-fields-holder' );
					$rowParent.remove();
				}
			);
		},
		qodefAddNewRowInner: function ( holder, $mainHolder ) {
			var $addInnerButton   = holder.find( '.qodef-repeater-inner-add a' ),
				templateInnerName = holder.find( '.qodef-repeater-inner-wrapper-main' ).data( 'template' ),
				rowInnerTemplate  = wp.template( 'qodef-repeater-inner-template-' + templateInnerName );

			$addInnerButton.off().on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					var $clickedButton    = $( this ),
						$parentRow        = $clickedButton.parents( '.qodef-repeater-fields-holder' ).first(),
						parentIndex       = $parentRow.data( 'index' ),
						$rowInnerContent  = $clickedButton.parent().parent().prev(),
						lastRowInnerIndex = $parentRow.find( '.qodef-repeater-inner-fields-holder' ).length;

					var $repeaterInnerRow = $(
						rowInnerTemplate(
							{
								rowIndex: parentIndex,
								rowInnerIndex: lastRowInnerIndex
							}
						)
					);

					$rowInnerContent.append( $repeaterInnerRow );
					qodefRepeater.qodefInitSortableInner( holder );
					qodefDependency.reinitRepeater( $mainHolder );
				}
			);
		},
		qodefRemoveRowInner: function ( holder ) {
			var repeaterInnerContent = holder.find( '.qodef-repeater-inner-wrapper-main' );

			repeaterInnerContent.off().on(
				'click',
				'.qodef-clone-inner-remove',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					if ( ! confirm( 'Are you sure you want to remove section?' ) ) {
						return;
					}

					var $removeButton = $( this );
					var $parent       = $removeButton.parents( '.qodef-repeater-inner-fields-holder' );

					$parent.remove();
				}
			);
		}
	};

	var qodefPerfectScrollbar = {
		init: function ( $holder, suppressScrollX ) {
			if ( $holder.length ) {
				qodefPerfectScrollbar.qodefInitScroll(
					$holder,
					typeof suppressScrollX !== 'undefined' ? suppressScrollX : true
				);
			}
		},
		qodefInitScroll: function ( $holder, suppressScrollX ) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: suppressScrollX
			};

			var $ps = new PerfectScrollbar(
				$holder[0],
				$defaultParams
			);

			$( window ).resize(
				function () {
					$ps.update();
				}
			);
		}
	};

	qodefFramework.qodefPerfectScrollbar = qodefPerfectScrollbar;

})( jQuery );
