<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Framework_Custom_Sidebar' ) ) {
	class QodeEssentialAddons_Framework_Custom_Sidebar {
		private $sidebars = array();
		private $db_name  = '';
		private $title    = '';

		public function __construct() {
			// Initialize variables.
			$this->db_name = 'qode_essential_addons_framework_custom_sidebars';
			$this->title   = esc_html__( 'Custom Sidebar', 'qode-essential-addons' );

			// Add custom sidebar form.
			add_action( 'widgets_admin_page', array( $this, 'add_custom_sidebar_form' ) );

			// Permission 5 is set to be same permission as Gutenberg plugin have.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_dashboard_sidebar_scripts' ), 5 );

			// Register custom sidebar (permission 500 is set to custom sidebar be at the last place).
			add_action( 'widgets_init', array( $this, 'register_custom_sidebar' ), 500 );

			// Add custom sidebar into db.
			add_action( 'wp_ajax_qode_essential_addons_framework_add_custom_sidebar', array( $this, 'add_custom_sidebar' ) );

			// Delete custom sidebar from db.
			add_action( 'wp_ajax_qode_essential_addons_framework_delete_custom_sidebar', array( $this, 'delete_custom_sidebar' ) );
		}

		public function add_custom_sidebar_form() {
			ob_start();

			$this->custom_sidebar_form();

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo ob_get_clean();
		}

		public function custom_sidebar_form() {
			?>
			<form class="qodef-custom-sidebar wp-block" method="POST" data-type="core/widget-area">
				<h3 class="qodef-custom-sidebar-title"><?php echo esc_html( $this->title ); ?></h3>
				<p class="qodef-custom-sidebar-description"><?php esc_html_e( 'This area allows you to add Custom widget area on your site', 'qode-essential-addons' ); ?></p>
				<div class="qodef-custom-sidebar-inputs">
					<input type="text" name="qodef-custom-sidebar-name" class="qodef-custom-sidebar-name" value="" placeholder="<?php esc_attr_e( 'Custom Sidebar Name', 'qode-essential-addons' ); ?>" required />
					<input type="submit" class="qodef-custom-sidebar-button button button-primary" value="<?php esc_attr_e( 'Add Sidebar', 'qode-essential-addons' ); ?>"/>
				</div>
				<div class="qodef-custom-sidebar-response"></div>
				<?php wp_nonce_field( 'qode_essential_addons_framework_validate_custom_sidebar', 'qode_essential_addons_framework_nonce_custom_sidebar' ); ?>
			</form>
			<?php
		}

		public function register_custom_sidebar() {

			if ( empty( $this->sidebars ) ) {
				$this->sidebars = get_option( $this->db_name );
			}

			// Sidebar config variables.
			$config = $this->get_sidebar_config();

			if ( is_array( $this->sidebars ) ) {
				foreach ( $this->sidebars as $sidebar ) {
					register_sidebar(
						array(
							'id'            => sanitize_title( $sidebar ),
							'class'         => 'qodef-custom-sidebar',
							'name'          => esc_attr( $sidebar ),
							'before_widget' => '<div class="widget %2$s" data-area="' . sanitize_title( $sidebar ) . '">',
							'after_widget'  => '</div>',
							'before_title'  => '<' . esc_attr( $config['title_tag'] ) . ' class="' . esc_attr( $config['title_class'] ) . '">',
							'after_title'   => '</' . esc_attr( $config['title_tag'] ) . '>',
						)
					);
				}
			}
		}

		public function add_custom_sidebar() {
			$custom_sidebar_name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';

			if ( ! empty( $custom_sidebar_name ) && isset( $_POST['nonce'] ) ) {
				$nonce = sanitize_text_field( wp_unslash( $_POST['nonce'] ) );

				if ( wp_verify_nonce( $nonce, 'qode_essential_addons_framework_validate_custom_sidebar' ) ) {
					$this->sidebars = get_option( $this->db_name );
					$sidebar_name   = $this->get_custom_sidebar_name( $custom_sidebar_name );
					$this->sidebars = ! $this->sidebars || empty( $this->sidebars ) ? array( $sidebar_name ) : array_merge( $this->sidebars, array( $sidebar_name ) );

					update_option( $this->db_name, $this->sidebars );

					qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Custom sidebar is added', 'qode-essential-addons' ), null, esc_url( admin_url( 'widgets.php' ) ) );
				} else {
					qode_essential_addons_framework_get_ajax_status( 'error', esc_html__( 'Nonce is invalid', 'qode-essential-addons' ) );
				}
			} else {
				qode_essential_addons_framework_get_ajax_status( 'error', esc_html__( 'POST is invalid', 'qode-essential-addons' ) );
			}
		}

		public function delete_custom_sidebar() {
			$custom_sidebar_name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';

			if ( ! empty( $custom_sidebar_name ) && isset( $_POST['nonce'] ) ) {
				$nonce = sanitize_text_field( wp_unslash( $_POST['nonce'] ) );

				if ( wp_verify_nonce( $nonce, 'qode_essential_addons_framework_validate_custom_sidebar' ) ) {
					$sidebar_name   = stripslashes( $custom_sidebar_name );
					$this->sidebars = get_option( $this->db_name );
					$sidebar_exist  = array_search( $sidebar_name, $this->sidebars, true );

					if ( false !== $sidebar_exist ) {
						unset( $this->sidebars[ $sidebar_exist ] );
						update_option( $this->db_name, $this->sidebars );

						qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Custom sidebar is deleted', 'qode-essential-addons' ) );
					} else {
						qode_essential_addons_framework_get_ajax_status( 'error', esc_html__( 'Custom sidebar name is invalid', 'qode-essential-addons' ) );
					}
				} else {
					qode_essential_addons_framework_get_ajax_status( 'error', esc_html__( 'Nonce is invalid', 'qode-essential-addons' ) );
				}
			} else {
				qode_essential_addons_framework_get_ajax_status( 'error', esc_html__( 'POST is invalid', 'qode-essential-addons' ) );
			}
		}

		// Checks is custom sidebar submitted and is name available.
		public function get_custom_sidebar_name( $name ) {

			if ( empty( $GLOBALS['wp_registered_sidebars'] ) ) {
				return $name;
			}

			$taken = array();
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$taken[] = sanitize_text_field( $sidebar['name'] );
			}

			if ( empty( $this->sidebars ) ) {
				$this->sidebars = array();
			}
			$taken = array_merge( $taken, $this->sidebars );

			if ( in_array( $name, $taken, true ) ) {
				$counter  = substr( $name, - 1 );
				$new_name = ! is_numeric( $counter ) ? $name . '1' : substr( $name, 0, - 1 ) . ( (int) $counter + 1 );
				$name     = $this->get_custom_sidebar_name( $new_name );
			}

			return $name;
		}

		public function get_sidebar_config() {

			// Config variables.
			$config = apply_filters(
				'qode_essential_addons_filter_framework_main_sidebar_config',
				array(
					'title_tag'   => 'h4',
					'title_class' => 'qodef-widget-title',
				)
			);

			return $config;
		}

		public function get_custom_sidebars( $enable_default = true ) {
			$custom_sidebars = get_option( 'qode_essential_addons_framework_custom_sidebars' );
			$sidebars        = array();

			if ( $enable_default ) {
				$sidebars[''] = esc_html__( 'Default', 'qode-essential-addons' );
			}

			if ( ! empty( $custom_sidebars ) ) {
				foreach ( $custom_sidebars as $custom_sidebar ) {
					$sidebars[ sanitize_title( $custom_sidebar ) ] = $custom_sidebar;
				}
			}

			return $sidebars;
		}

		public function enqueue_dashboard_sidebar_scripts( $hook ) {
			if ( 'widgets.php' === $hook ) {
				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
				wp_enqueue_style( 'qode-framework-sidebar', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/sidebar/assets/css/sidebar.css' );
				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters
				wp_enqueue_script( 'qode-framework-sidebar', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/sidebar/assets/js/custom-sidebar.js', array( 'jquery' ) );
			}
		}
	}
}
