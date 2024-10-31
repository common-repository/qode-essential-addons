<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_include_blog_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function qode_essential_addons_include_blog_shortcodes() {
		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/blog/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_essential_addons_action_framework_before_shortcodes_register', 'qode_essential_addons_include_blog_shortcodes' );
}

if ( ! function_exists( 'qode_essential_addons_include_blog_shortcodes_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function qode_essential_addons_include_blog_shortcodes_widget() {
		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/blog/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_essential_addons_action_framework_before_widgets_register', 'qode_essential_addons_include_blog_shortcodes_widget' );
}

if ( ! function_exists( 'qode_essential_addons_set_blog_single_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function qode_essential_addons_set_blog_single_sidebar_layout( $layout ) {

		if ( is_singular( 'post' ) ) {
			$option = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_single_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_layout', true );

			if ( ! empty( $meta_option ) ) {
				$layout = $meta_option;
			}
		}

		return $layout;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_sidebar_layout', 'qode_essential_addons_set_blog_single_sidebar_layout' );
	add_filter( 'the_q_filter_sidebar_layout', 'qode_essential_addons_set_blog_single_sidebar_layout' );
	add_filter( 'qi_filter_sidebar_layout', 'qode_essential_addons_set_blog_single_sidebar_layout' );
	add_filter( 'qi_gutenberg_filter_sidebar_layout', 'qode_essential_addons_set_blog_single_sidebar_layout' );
}

if ( ! function_exists( 'qode_essential_addons_set_blog_single_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function qode_essential_addons_set_blog_single_custom_sidebar_name( $sidebar_name ) {

		if ( is_singular( 'post' ) ) {
			$option = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_single_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_custom_sidebar', true );

			if ( ! empty( $meta_option ) ) {
				$sidebar_name = $meta_option;
			}
		}

		return $sidebar_name;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_sidebar_name', 'qode_essential_addons_set_blog_single_custom_sidebar_name' );
	add_filter( 'the_q_filter_sidebar_name', 'qode_essential_addons_set_blog_single_custom_sidebar_name' );
	add_filter( 'qi_filter_sidebar_name', 'qode_essential_addons_set_blog_single_custom_sidebar_name' );
	add_filter( 'qi_gutenberg_filter_sidebar_name', 'qode_essential_addons_set_blog_single_custom_sidebar_name' );
}

if ( ! function_exists( 'qode_essential_addons_enable_posts_order' ) ) {
	/**
	 * Function that enable page attributes options for blog single page
	 */
	function qode_essential_addons_enable_posts_order() {
		add_post_type_support( 'post', 'page-attributes' );
	}

	add_action( 'admin_init', 'qode_essential_addons_enable_posts_order' );
}

if ( ! function_exists( 'qode_essential_addons_get_blog_list_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on blog list page
	 *
	 * @return int
	 */
	function qode_essential_addons_get_blog_list_excerpt_length() {
		$length = apply_filters( 'qode_essential_addons_filter_post_excerpt_length', 180 );

		return intval( $length );
	}
}

if ( ! function_exists( 'qode_essential_addons_set_blog_list_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param int $excerpt_length
	 *
	 * @return int
	 */
	function qode_essential_addons_set_blog_list_excerpt_length( $excerpt_length ) {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_list_excerpt_number_of_characters' );

		if ( '' !== $option ) {
			$excerpt_length = $option;
		}

		return $excerpt_length;
	}

	add_filter( 'qode_essential_addons_filter_post_excerpt_length', 'qode_essential_addons_set_blog_list_excerpt_length' );

	// @WPThemeHookList.
	add_filter( 'the_two_filter_post_excerpt_length', 'qode_essential_addons_set_blog_list_excerpt_length' );
	add_filter( 'the_q_filter_post_excerpt_length', 'qode_essential_addons_set_blog_list_excerpt_length' );
	add_filter( 'qi_filter_post_excerpt_length', 'qode_essential_addons_set_blog_list_excerpt_length' );
	add_filter( 'qi_gutenberg_filter_post_excerpt_length', 'qode_essential_addons_set_blog_list_excerpt_length' );
}

if ( ! function_exists( 'qode_essential_addons_set_blog_list_show_read_more' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param int $excerpt_length
	 *
	 * @return int
	 */
	function qode_essential_addons_set_blog_list_show_read_more( $show ) {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_list_hide_read_more' );

		if ( 'yes' === $option ) {
			$show = false;
		}

		return $show;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_show_read_more', 'qode_essential_addons_set_blog_list_show_read_more' );
	add_filter( 'the_q_filter_show_read_more', 'qode_essential_addons_set_blog_list_show_read_more' );
	add_filter( 'qi_filter_show_read_more', 'qode_essential_addons_set_blog_list_show_read_more' );
	add_filter( 'qi_gutenberg_filter_show_read_more', 'qode_essential_addons_set_blog_list_show_read_more' );
}

if ( ! function_exists( 'qode_essential_addons_set_blog_list_quote_link_tag' ) ) {
	/**
	 * Function that sets title tag for quote and link posts
	 *
	 * @param int $excerpt_length
	 *
	 * @return int
	 */
	function qode_essential_addons_set_blog_list_quote_link_tag( $title_tag ) {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_list_quote_link_tag' );

		if ( '' !== $option ) {
			$title_tag = $option;
		}

		return $title_tag;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_post_quote_link_tag', 'qode_essential_addons_set_blog_list_quote_link_tag' );
	add_filter( 'the_q_filter_post_quote_link_tag', 'qode_essential_addons_set_blog_list_quote_link_tag' );
	add_filter( 'qi_filter_post_quote_link_tag', 'qode_essential_addons_set_blog_list_quote_link_tag' );
	add_filter( 'qi_gutenberg_filter_post_quote_link_tag', 'qode_essential_addons_set_blog_list_quote_link_tag' );
}

if ( ! function_exists( 'qode_essential_addons_set_blog_archive_blog_classes' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param int $excerpt_length
	 *
	 * @return int
	 */
	function qode_essential_addons_set_blog_archive_blog_classes( $classes ) {

		$columns         = ! empty( qode_essential_addons_get_post_value_through_levels( 'qodef_blog_archive_columns' ) ) ? 'qodef-col-num--' . qode_essential_addons_get_post_value_through_levels( 'qodef_blog_archive_columns' ) : '';
		$space           = ! empty( qode_essential_addons_get_post_value_through_levels( 'qodef_blog_archive_space' ) ) ? 'qodef-gutter--' . qode_essential_addons_get_post_value_through_levels( 'qodef_blog_archive_space' ) : '';
		$alignment_class = ! empty( qode_essential_addons_get_post_value_through_levels( 'qodef_blog_list_alignment' ) ) ? 'qodef-blog-alignment--' . qode_essential_addons_get_post_value_through_levels( 'qodef_blog_list_alignment' ) : '';

		if ( ! is_single() ) {
			$classes[] = 'qodef-grid qodef-layout--columns qodef-responsive--predefined';
			$classes[] = $columns;
			$classes[] = $space;
			$classes[] = $alignment_class;
		}

		return $classes;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_blog_holder_classes', 'qode_essential_addons_set_blog_archive_blog_classes' );
	add_filter( 'the_q_filter_blog_holder_classes', 'qode_essential_addons_set_blog_archive_blog_classes' );
	add_filter( 'qi_filter_blog_holder_classes', 'qode_essential_addons_set_blog_archive_blog_classes' );
	add_filter( 'qi_gutenberg_filter_blog_holder_classes', 'qode_essential_addons_set_blog_archive_blog_classes' );
}

if ( ! function_exists( 'qode_essential_addons_get_allowed_pages_for_blog_sidebar_layout' ) ) {
	/**
	 * Function that return pages where blog sidebar is allowed
	 *
	 * @return bool
	 */
	function qode_essential_addons_get_allowed_pages_for_blog_sidebar_layout() {
		return ( is_archive() || ( is_home() && is_front_page() ) ) && 'post' === get_post_type();
	}
}

if ( ! function_exists( 'qode_essential_addons_set_blog_archive_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function qode_essential_addons_set_blog_archive_sidebar_layout( $layout ) {

		if ( qode_essential_addons_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_archive_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_sidebar_layout', 'qode_essential_addons_set_blog_archive_sidebar_layout' );
	add_filter( 'the_q_filter_sidebar_layout', 'qode_essential_addons_set_blog_archive_sidebar_layout' );
	add_filter( 'qi_filter_sidebar_layout', 'qode_essential_addons_set_blog_archive_sidebar_layout' );
	add_filter( 'qi_gutenberg_filter_sidebar_layout', 'qode_essential_addons_set_blog_archive_sidebar_layout' );
}

if ( ! function_exists( 'qode_essential_addons_set_blog_archive_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function qode_essential_addons_set_blog_archive_custom_sidebar_name( $sidebar_name ) {

		if ( qode_essential_addons_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_archive_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_sidebar_name', 'qode_essential_addons_set_blog_archive_custom_sidebar_name' );
	add_filter( 'the_q_filter_sidebar_name', 'qode_essential_addons_set_blog_archive_custom_sidebar_name' );
	add_filter( 'qi_filter_sidebar_name', 'qode_essential_addons_set_blog_archive_custom_sidebar_name' );
	add_filter( 'qi_gutenberg_filter_sidebar_name', 'qode_essential_addons_set_blog_archive_custom_sidebar_name' );
}

if ( ! function_exists( 'qode_essential_addons_get_blog_single_post_taxonomies' ) ) {
	/**
	 * Function that return single post taxonomies list
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	function qode_essential_addons_get_blog_single_post_taxonomies( $post_id ) {
		$options = array();

		if ( ! empty( $post_id ) ) {
			$options['tag']      = get_the_tags( $post_id );
			$options['category'] = get_the_category( $post_id );
		}

		return $options;
	}
}

if ( ! function_exists( 'qode_essential_addons_set_blog_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_blog_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$info_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_post_info' );
		$info_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_post_info' );

		if ( ! empty( $info_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'.widget.widget_recent_entries ul li .post-date',
					),
					array(
						'body[class*="theme-qi"] .qodef-blog .qodef-info-style .qodef-e-info-item a',
						'body[class*="theme-qi"] .qodef-blog .qodef-info-style .qodef-e-info-item:after',
						'body[class*="theme-qi"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info.qodef-info--top .qodef-e-info-item a',
						'body[class*="theme-qi"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info.qodef-info--top .qodef-e-info-item:after',
						'body[class*="theme-qi"] .widget.widget_rss ul a.rsswidget',
						'body[class*="theme-qi"] #qodef-page-comments-list .qodef-comment-item .qodef-e-date a',
					),
					array(
						'body[class*="the-two"] .qodef-blog .qodef-e-info .qodef-e-info-item a',
						'body[class*="the-two"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info.qodef-info--top .qodef-e-info-item a',
						'body[class*="the-two"] .widget.widget_rss ul a.rsswidget',
						'body[class*="the-two"] #qodef-page-comments-list .qodef-comment-item .qodef-e-date a',
					)
				),
				$info_styles
			);
		}

		if ( ! empty( $info_styles['color'] ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'body[class*="theme-qi"] .qodef-blog .qodef-info-style',
					),
					array(
						'body[class*="theme-qi"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info.qodef-info--top .qodef-e-info-item',
					)
				),
				array(
					'color' => $info_styles['color'],
				)
			);
		}

		if ( ! empty( $info_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'body[class*="theme-qi"] .qodef-blog .qodef-info-style .qodef-e-info-item a:hover',
						'body[class*="theme-qi"] .qodef-blog .qodef-info-style .qodef-e-info-item a:focus',
						'body[class*="theme-qi"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info .qodef-e-info-item a:hover',
						'body[class*="theme-qi"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info .qodef-e-info-item a:focus',
						'body[class*="theme-qi"] #qodef-page-comments-list .qodef-comment-item .qodef-e-date a:hover',
						'body[class*="theme-qi"] #qodef-page-comments-list .qodef-comment-item .qodef-e-date a:focus',
						'body[class*="theme-qi"] .widget.widget_rss ul a.rsswidget:hover',
					),
					array(
						'body[class*="the-two"] .qodef-blog .qodef-e-info .qodef-e-info-item a:hover',
						'body[class*="the-two"] .qodef-blog .qodef-e-info .qodef-e-info-item a:focus',
						'body[class*="the-two"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info .qodef-e-info-item a:hover',
						'body[class*="the-two"] .qodef-blog-shortcode.qodef-item-layout--standard .qodef-blog-item .qodef-e-info .qodef-e-info-item a:focus',
						'body[class*="the-two"] #qodef-page-comments-list .qodef-comment-item .qodef-e-date a:hover',
						'body[class*="the-two"] #qodef-page-comments-list .qodef-comment-item .qodef-e-date a:focus',
						'body[class*="the-two"] .widget.widget_rss ul a.rsswidget:hover',
					)
				),
				$info_hover_styles
			);
		}

		$alignment = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_list_alignment' );

		if ( '' !== $alignment ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-blog.qodef--list',
				),
				array(
					'text-align' => $alignment,
				)
			);

			switch ( $alignment ) {
				case 'left':
					$flex_alignment = 'flex-start';
					break;
				case 'right':
					$flex_alignment = 'flex-end';
					break;
				default:
					$flex_alignment = $alignment;
					break;
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-blog.qodef--list .qodef-blog-item .qodef-e-info',
				),
				array(
					'justify-content' => $flex_alignment,
				)
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_blog_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_blog_info_draw_classes' ) ) {

	function qode_essential_addons_set_blog_info_draw_classes( $classes ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$draw_classes = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_post_info' );

		if ( ! empty( $draw_classes ) ) {
			$classes [] = $draw_classes;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_set_blog_info_draw_classes' );
}

if ( ! function_exists( 'qode_essential_addons_get_post_image' ) ) {

	function qode_essential_addons_get_post_image( $post_id ) {
		$image = apply_filters( 'qode_essential_addons_filter_get_post_image', get_the_post_thumbnail( $post_id, 'full' ), $post_id );

		return $image;
	}
}
