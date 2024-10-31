<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$excerpt = qode_essential_addons_get_custom_post_type_excerpt( isset( $excerpt_length ) ? $excerpt_length : 0 );

if ( ! empty( $excerpt ) ) { ?>
	<p itemprop="description" class="qodef-woo-product-excerpt"><?php echo esc_html( $excerpt ); ?></p>
<?php } ?>
