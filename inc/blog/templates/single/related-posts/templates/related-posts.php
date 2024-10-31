<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$current_post_id = get_the_ID();
$is_enabled      = qode_essential_addons_get_post_value_through_levels( 'qodef_blog_single_enable_related_posts' );
$related_posts   = qode_essential_addons_get_custom_post_type_related_posts( $current_post_id, qode_essential_addons_get_blog_single_post_taxonomies( $current_post_id ) );

if ( 'yes' === $is_enabled && ! empty( $related_posts ) && class_exists( 'QodeEssentialAddons_Blog_List_Shortcode' ) ) { ?>
	<div id="qodef-related-posts" class="qodef-m">
		<h2 class="qodef-m-title"><?php esc_html_e( 'Related posts', 'qode-essential-addons' ); ?></h2>
		<?php
		$params = apply_filters(
			'qode_essential_addons_filter_blog_single_related_posts_params',
			array(
				'columns'            => '3',
				'posts_per_page'     => 3,
				'additional_params'  => 'id',
				'post_ids'           => $related_posts['items'],
				'title_tag'          => 'h4',
				'excerpt_length'     => '100',
				'columns_responsive' => 'custom',
				'columns_1440'       => '3',
				'columns_1366'       => '3',
				'columns_1024'       => '2',
				'columns_768'        => '2',
				'columns_680'        => '1',
				'columns_480'        => '1',
			)
		);

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo QodeEssentialAddons_Blog_List_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
