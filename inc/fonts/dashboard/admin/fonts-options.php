<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function qode_essential_addons_add_fonts_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Fonts Options', 'qode-essential-addons' ),
				'icon'        => 'fa fa-cog',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'qode-essential-addons' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts',
					),
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose Google Fonts you wish to use on your website', 'qode-essential-addons' ),
					'button_text' => esc_html__( 'Add New Google Font', 'qode-essential-addons' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type'  => 'googlefont',
					'name'        => 'qodef_choose_google_font',
					'title'       => esc_html__( 'Google Font', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose Google Font', 'qode-essential-addons' ),
					'args'        => array(
						'include' => 'google-fonts',
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose default Google Font weight(s) for your website. Note that selecting multiple values may have an impact on page load time', 'qode-essential-addons' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'qode-essential-addons' ),
						'100i' => esc_html__( '100 Thin Italic', 'qode-essential-addons' ),
						'200'  => esc_html__( '200 Extra-Light', 'qode-essential-addons' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'qode-essential-addons' ),
						'300'  => esc_html__( '300 Light', 'qode-essential-addons' ),
						'300i' => esc_html__( '300 Light Italic', 'qode-essential-addons' ),
						'400'  => esc_html__( '400 Regular', 'qode-essential-addons' ),
						'400i' => esc_html__( '400 Regular Italic', 'qode-essential-addons' ),
						'500'  => esc_html__( '500 Medium', 'qode-essential-addons' ),
						'500i' => esc_html__( '500 Medium Italic', 'qode-essential-addons' ),
						'600'  => esc_html__( '600 Semi-Bold', 'qode-essential-addons' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'qode-essential-addons' ),
						'700'  => esc_html__( '700 Bold', 'qode-essential-addons' ),
						'700i' => esc_html__( '700 Bold Italic', 'qode-essential-addons' ),
						'800'  => esc_html__( '800 Extra-Bold', 'qode-essential-addons' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'qode-essential-addons' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'qode-essential-addons' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'qode-essential-addons' ),
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose default Google Font style(s) for your website. Note that selecting multiple values may have an impact on page load time', 'qode-essential-addons' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'qode-essential-addons' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'qode-essential-addons' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'qode-essential-addons' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'qode-essential-addons' ),
						'greek'        => esc_html__( 'Greek', 'qode-essential-addons' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'qode-essential-addons' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_fonts_options', qode_essential_addons_get_admin_options_map_position( 'fonts' ) );
}
