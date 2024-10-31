<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Framework_Import_Menu_Settings' ) ) {
	class QodeEssentialAddons_Framework_Import_Menu_Settings {

		/**
		 * Instance of module property
		 *
		 * @var $instance QodeEssentialAddons_Framework_Import_Menu_Settings of current class
		 */
		private static $instance;

		/**
		 * Instance of module class
		 *
		 * @return QodeEssentialAddons_Framework_Import_Menu_Settings
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function import( $demo ) {

			if ( isset( $demo['demo_import_options'] ) ) {

				global $wpdb;

				$settings_url = $demo['demo_menu_settings_file_url'];
				$menus_data   = qode_essential_addons_decode_content( $settings_url );

				if ( false !== $menus_data ) {

					if ( empty( $menus_data ) ) {
						qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'File With Settings Is Empty', 'qode-essential-addons' ) );
					}

					$menu_array  = array();
					$terms_table = $wpdb->prefix . 'terms';

					foreach ( $menus_data as $registered_menu => $menu_slug ) {
						// phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
						$term_rows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$terms_table} where slug=%s", $menu_slug ), ARRAY_A );

						if ( isset( $term_rows[0]['term_id'] ) ) {
							$term_id_by_slug = $term_rows[0]['term_id'];
						} else {
							$term_id_by_slug = null;
						}

						$menu_array[ $registered_menu ] = $term_id_by_slug;
					}
					$results = set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_array ) );

					qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Menus Set For Proper Locations', 'qode-essential-addons' ) );
				} else {
					qode_essential_addons_framework_get_ajax_status( 'error', esc_html__( 'Problem With File Content', 'qode-essential-addons' ) );
				}
			}
		}
	}
}
