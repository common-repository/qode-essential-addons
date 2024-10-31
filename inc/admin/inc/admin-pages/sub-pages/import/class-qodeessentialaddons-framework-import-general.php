<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Framework_Import_General' ) ) {
	class QodeEssentialAddons_Framework_Import_General {

		/**
		 * @var QodeEssentialAddons_Framework_Import_General of current class
		 */
		private static $instance;
		private $chunk_number;
		private $import_images;
		private $transient_name;

		public function __construct() {
			require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-pages/sub-pages/import/importer/wordpress-importer.php';

			$this->chunk_number   = 10;
			$this->import_images  = true;
			$this->transient_name = 'qodef_import_block_';

			// start import.
			add_action( 'wp_ajax_import_action', array( &$this, 'import_action' ) );
		}

		/**
		 * Instance of module class
		 *
		 * @return QodeEssentialAddons_Framework_Import_General
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function get_chunk_number() {
			return $this->chunk_number;
		}

		public function import_action() {

			if ( isset( $_POST ) || ! empty( $_POST ) ) {

				if ( isset( $_POST['options']['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['options']['nonce'] ) ), 'qodef_import_nonce' ) ) {
					$demo_key  = isset( $_POST['options']['demo'] ) ? sanitize_text_field( wp_unslash( $_POST['options']['demo'] ) ) : '';
					$demo_list = qode_essential_addons_demos_list();
					$demo      = $demo_list[ $demo_key ];

					if ( isset( $_POST['options']['action'] ) ) {
						switch ( $_POST['options']['action'] ) :
							case 'widgets':
								QodeEssentialAddons_Framework_Import_Widgets::get_instance()->import( $demo );
								break;
							case 'options':
								QodeEssentialAddons_Framework_Import_Options::get_instance()->import( $demo );
								break;
							case 'settings-page':
								QodeEssentialAddons_Framework_Import_Settings_Pages::get_instance()->import( $demo );
								break;
							case 'menu-settings':
								QodeEssentialAddons_Framework_Import_Menu_Settings::get_instance()->import( $demo );
								break;
							case 'content':
								// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
								$this->import_content( $demo, $_POST['options'] );
								break;
						endswitch;
					}
				}
			}

			wp_die();
		}

		public function import_content( $demo, $options ) {

			$options_type = isset( $options['contentType'] ) ? $options['contentType'] : 'posts';
			$demo_url     = $demo['demo_file_url'];

			switch ( $options_type ) :
				case 'posts':
					$this->import_posts( $demo_url, $demo );
					break;
				case 'attachments':
					// phpcs:ignore WordPress.Security.NonceVerification.Missing
					$this->import_images = isset( $_POST['options']['images'] ) && 1 === (int) $_POST['options']['images'] ? true : false;
					$this->import_attachments( $options['attachmentNumber'] );
					break;
				case 'terms':
					$this->import_terms( $demo_url );
					break;
			endswitch;
		}

		public function import_terms( $demo_url ) {

			ob_start();

			if ( qode_essential_addons_framework_is_installed( 'woocommerce' ) ) {
				add_filter( 'wp_import_posts', array( $this, 'proccess_wc_attributes' ) );
			}

			add_filter( 'wp_import_posts', array( $this, 'save_block_attachments' ) );

			$import_object = new Qode_WP_Import();
			set_time_limit( 0 );
			$import_object->import( $demo_url );

			$attachments_blocks = apply_filters( 'qode_essential_addons_filter_import_attachments_blocks', 0 );

			ob_get_clean();

			qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Terms Imported Successfully', 'qode-essential-addons' ), array( 'number_of_blocks' => $attachments_blocks ) );
		}

		public function import_attachments( $i ) {
			$ajax_data                     = array();
			$ajax_data['attachment_block'] = $i;

			if ( false === $this->import_images ) {
				qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Skip Import Attachments', 'qode-essential-addons' ), $ajax_data );
			}

			$attachments = get_transient( $this->transient_name . $i );

			if ( ! empty( $attachments ) ) {
				$import_results            = $this->procced_attachments( $i, $attachments );
				$ajax_data['imported_ids'] = $import_results;

				qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Attachments Imported Successfully - Block ', 'qode-essential-addons' ) . $i, $ajax_data );
			}
		}

		public function procced_attachments( $block, $attachments, $imported = array(), $errors = array() ) {

			ob_start();
			$import_object = new Qode_WP_Import();
			set_time_limit( 0 );

			add_filter( 'upload_mimes', array( $this, 'enable_svg_import' ) );

			$import_object->fetch_attachments = $this->import_images;

			$import_object->posts = $attachments;
			$import_results       = $import_object->process_posts();

			ob_get_clean();

			$imported_ids = apply_filters( 'qode_essential_addons_filter_import_attachments_success', $imported );
			$error_ids    = apply_filters( 'qode_essential_addons_filter_import_attachments_errors', $errors );

			if ( count( $attachments ) !== count( $imported_ids ) ) {
				$this->procced_attachments( $block, array_intersect_key( $attachments, $error_ids ), $imported_ids, $error_ids );
			} else {
				delete_transient( $this->transient_name . $block );
			}

			return $imported_ids;
		}

		public function import_posts( $demo_url, $demo ) {

			ob_start();

			add_filter( 'wp_import_posts', array( $this, 'prepare_posts' ) );
			add_filter( 'wp_import_categories', array( $this, 'prepare_terms' ) );
			add_filter( 'wp_import_tags', array( $this, 'prepare_terms' ) );
			add_filter( 'wp_import_terms', array( $this, 'prepare_terms' ) );

			$import_object = new Qode_WP_Import();
			set_time_limit( 0 );

			$import_object->import( $demo_url );

			ob_get_clean();

			$this->update_meta_fields_after_import( $demo );

			qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Posts Imported Successfully', 'qode-essential-addons' ) );
		}

		public function save_block_attachments( $posts ) {
			$attachments        = array();
			$attachments_blocks = array();

			foreach ( $posts as $post ) {

				if ( 'attachment' === $post['post_type'] ) {
					$attachments[ $post['post_id'] ] = $post;
				}
			}

			$attachments_blocks = array_chunk( $attachments, $this->chunk_number, true );
			$number_of_blocks   = count( $attachments_blocks );

			if ( $number_of_blocks > 0 ) {
				for ( $i = 1; $i <= $number_of_blocks; $i++ ) {
					set_transient( $this->transient_name . $i, $attachments_blocks[ $i - 1 ] );
				}
			}

			add_filter(
				'qode_essential_addons_filter_import_attachments_blocks',
				function () use ( $number_of_blocks ) {
					return $number_of_blocks;
				},
				10,
				2
			);

			set_transient( 'qodef_total_import_blocks', $number_of_blocks );

			$posts = array();

			return $posts;
		}

		public function prepare_posts( $posts ) {
			$posts_wa = array();

			foreach ( $posts as $post ) {
				if ( 'attachment' !== $post['post_type'] ) {
					$posts_wa[] = $post;
				}
			}

			return $posts_wa;
		}

		public function prepare_terms( $terms ) {
			$terms = array();

			return $terms;
		}

		public function enable_svg_import( $mimes ) {
			$mimes['svg'] = 'image/svg+xml';

			return $mimes;
		}

		public function proccess_wc_attributes( $posts ) {

			foreach ( $posts as $post ) {
				if ( 'product' === $post['post_type'] && ! empty( $post['terms'] ) ) {
					foreach ( $post['terms'] as $term ) {
						if ( strstr( $term['domain'], 'pa_' ) ) {
							if ( ! taxonomy_exists( $term['domain'] ) ) {
								$attribute_name = wc_attribute_taxonomy_slug( $term['domain'] );

								// Create the taxonomy.
								if ( ! in_array( $attribute_name, wc_get_attribute_taxonomies(), true ) ) {
									wc_create_attribute(
										array(
											'name'         => $attribute_name,
											'slug'         => $attribute_name,
											'type'         => 'select',
											'order_by'     => 'menu_order',
											'has_archives' => false,
										)
									);
								}

								// Register the taxonomy now so that the import works!
								register_taxonomy(
									$term['domain'],
									apply_filters( 'woocommerce_taxonomy_objects_' . $term['domain'], array( 'product' ) ),
									apply_filters(
										'woocommerce_taxonomy_args_' . $term['domain'],
										array(
											'hierarchical' => true,
											'show_ui'      => false,
											'query_var'    => true,
											'rewrite'      => false,
										)
									)
								);
							}
						}
					}
				}
			}

			return $posts;
		}

		public function update_meta_fields_after_import( $demo ) {
			global $wpdb;

			$url      = esc_url( home_url( '/' ) );
			$demo_url = esc_url( $demo['demo_preview_url'] );

			$sql_query = "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_value LIKE '%" . esc_url( $demo_url ) . "%';";
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.NotPrepared
			$meta_values = $wpdb->get_results( $sql_query );

			if ( ! empty( $meta_values ) ) {
				foreach ( $meta_values as $meta_value ) {
					$new_value = $this->recalc_serialized_lengths( str_replace( $demo_url, $url, $meta_value->meta_value ) );

					// phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.SlowDBQuery.slow_db_query_meta_value
					$wpdb->update( $wpdb->postmeta, array( 'meta_value' => $new_value ), array( 'meta_id' => $meta_value->meta_id ) );
				}
			}

			if ( qode_essential_addons_framework_is_installed( 'elementor' ) && method_exists( '\Elementor\Utils', 'replace_urls' ) ) {
				\Elementor\Utils::replace_urls( $demo_url, $url );
			}
		}

		public function recalc_serialized_lengths( $s_object ) {
			$ret = preg_replace_callback(
				'!s:(\d+):"(.*?)";!',
				array(
					$this,
					'recalc_serialized_lengths_callback',
				),
				$s_object
			);

			return $ret;
		}

		public function recalc_serialized_lengths_callback( $matches ) {
			return 's:' . strlen( $matches[2] ) . ":\"$matches[2]\";";
		}
	}

	QodeEssentialAddons_Framework_Import_General::get_instance();
}
