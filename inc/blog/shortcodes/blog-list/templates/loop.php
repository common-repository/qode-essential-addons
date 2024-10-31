<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) :
		$query_result->the_post();

		$params['image_dimension'] = $this_shortcode->get_list_item_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo apply_filters( 'qode_essential_addons_filter_blog_list_sc_layout_path', qode_essential_addons_get_list_sc_template_part( 'blog/shortcodes/blog-list', 'layouts/' . $layout, get_post_format(), $params ), $layout, get_post_format(), $params );
	endwhile;
} else {
	// Include global posts not found.
	qode_essential_addons_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
