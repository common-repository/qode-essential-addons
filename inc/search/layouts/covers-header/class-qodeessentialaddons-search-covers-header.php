<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Search_Covers_Header extends QodeEssentialAddons_Search {
	private static $instance;

	public function __construct() {
		parent::__construct();

		add_action( 'wp', array( $this, 'load_template' ), 111 );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function return_template() {
		qode_essential_addons_template_part( 'search/layouts/' . $this->get_search_layout(), 'templates/' . $this->get_search_layout() );
	}

	public function load_template() {
		if ( is_active_widget( false, false, 'qode_essential_addons_search_opener' ) ) {

			$actions         = array();
			$sidebars        = qode_essential_addons_framework_get_widget_sidebars( 'qode_essential_addons_search_opener' );
			$custom_sidebars = qode_essential_addons_get_custom_sidebars();
			$page_id         = qode_essential_addons_framework_get_page_id();

			foreach ( $sidebars as $sidebar ) {
				// @WPThemeHookOverridingTemplates.
				if ( 'qodef-header-widget-area-one' === $sidebar || 'qodef-header-widget-area-two' === $sidebar ) {
					if ( qode_essential_addons_framework_is_installed( 'the-two-theme' ) ) {
						$actions[] = 'the_two_action_after_page_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'the-q-theme' ) ) {
						$actions[] = 'the_q_action_after_page_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'qi-theme' ) ) {
						$actions[] = 'qi_action_after_page_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'qi-gutenberg-theme' ) ) {
						$actions[] = 'qi_gutenberg_action_after_page_header_inner';
					}
					$actions[] = 'qode_essential_addons_action_after_header';
					$actions[] = 'qode_essential_addons_action_after_sticky_header';
				} elseif ( 'qodef-mobile-header-widget-area' === $sidebar ) {
					if ( qode_essential_addons_framework_is_installed( 'the-two-theme' ) ) {
						$actions[] = 'the_two_action_after_page_mobile_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'the-q-theme' ) ) {
						$actions[] = 'the_q_action_after_page_mobile_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'qi-theme' ) ) {
						$actions[] = 'qi_action_after_page_mobile_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'qi-gutenberg-theme' ) ) {
						$actions[] = 'qi_gutenberg_action_after_page_mobile_header_inner';
					}
				} elseif ( 'qodef-top-area-left' === $sidebar || 'qodef-top-area-right' === $sidebar ) {
					$actions[] = 'qode_essential_addons_action_after_top_area';
					if ( qode_essential_addons_framework_is_installed( 'the-two-theme' ) ) {
						$actions[] = 'the_two_action_after_page_mobile_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'the-q-theme' ) ) {
						$actions[] = 'the_q_action_after_page_mobile_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'qi-theme' ) ) {
						$actions[] = 'qi_action_after_page_mobile_header_inner';
					}
					if ( qode_essential_addons_framework_is_installed( 'qi-gutenberg-theme' ) ) {
						$actions[] = 'qi_gutenberg_action_after_page_mobile_header_inner';
					}
				} elseif ( array_key_exists( $sidebar, $custom_sidebars ) ) {
					$custom_menu_widget_area_one = get_post_meta( $page_id, 'qodef_header_custom_widget_area_one', true );
					$custom_menu_widget_area_two = get_post_meta( $page_id, 'qodef_header_custom_widget_area_two', true );

					if ( $sidebar === $custom_menu_widget_area_one || $sidebar === $custom_menu_widget_area_two ) {
						if ( qode_essential_addons_framework_is_installed( 'the-two-theme' ) ) {
							$actions[] = 'the_two_action_after_page_header_inner';
						}
						if ( qode_essential_addons_framework_is_installed( 'the-q-theme' ) ) {
							$actions[] = 'the_q_action_after_page_header_inner';
						}
						if ( qode_essential_addons_framework_is_installed( 'qi-theme' ) ) {
							$actions[] = 'qi_action_after_page_header_inner';
						}
						if ( qode_essential_addons_framework_is_installed( 'qi-gutenberg-theme' ) ) {
							$actions[] = 'qi_gutenberg_action_after_page_header_inner';
						}

						$actions[] = 'qode_essential_addons_action_after_header';
						$actions[] = 'qode_essential_addons_action_after_sticky_header';
					}
				}
			}

			foreach ( $actions as $action ) {
				add_action( $action, array( $this, 'return_template' ) );
			}
		}
	}
}
