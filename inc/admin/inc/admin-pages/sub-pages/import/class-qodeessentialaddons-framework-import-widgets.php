<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Framework_Import_Widgets' ) ) {
	class QodeEssentialAddons_Framework_Import_Widgets {

		/**
		 * Instance of module property
		 *
		 * @var QodeEssentialAddons_Framework_Import_Widgets of current class
		 */
		private static $instance;

		/**
		 * Instance of module class
		 *
		 * @return QodeEssentialAddons_Framework_Import_Widgets
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function import( $demo ) {
			$widgets_url     = $demo['demo_widgets_file_url'];
			$widgets_content = qode_essential_addons_decode_content( $widgets_url );

			if ( false !== $widgets_content ) {
				foreach ( (array) $widgets_content['widgets'] as $widget_id => $widget_data ) {
					$widget_data = $this->fix_nav_menu_widgets( $widget_data, $widget_id );
					update_option( 'widget_' . $widget_id, $widget_data );
				}
			}

			$this->import_sidebars_widgets( $widgets_url );
		}

		public function import_sidebars_widgets( $url ) {

			$sidebars = get_option( 'sidebars_widgets' );
			unset( $sidebars['array_version'] );
			$data = qode_essential_addons_decode_content( $url );

			if ( $data && is_array( $data['sidebars'] ) ) {

				$sidebars = array_merge( (array) $sidebars, (array) $data['sidebars'] );
				unset( $sidebars['wp_inactive_widgets'] );
				$sidebars                  = array_merge( array( 'wp_inactive_widgets' => array() ), $sidebars );
				$sidebars['array_version'] = 2;

				update_option( 'sidebars_widgets', $sidebars );

				qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Widgets Imported Successfully', 'qode-essential-addons' ) );
			}
		}

		public function fix_nav_menu_widgets( $widget_data, $widget_id ) {

			if ( 'nav_menu' === $widget_id ) {
				$imported_terms = get_transient( 'qodef_imported_terms' );

				if ( false !== $imported_terms ) {
					$temp_multiwidget = $widget_data['_multiwidget'];
					unset( $widget_data['_multiwidget'] );

					foreach ( $widget_data as $widget_data_id => $widget_data_content ) {

						if ( isset( $imported_terms[ $widget_data_content['nav_menu'] ] ) ) {
							$widget_data[ $widget_data_id ]['nav_menu'] = $imported_terms[ $widget_data_content['nav_menu'] ];
						}
					}

					$widget_data['_multiwidget'] = $temp_multiwidget;
				}
			}

			return $widget_data;
		}
	}
}
