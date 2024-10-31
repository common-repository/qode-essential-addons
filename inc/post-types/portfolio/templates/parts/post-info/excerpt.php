<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( post_password_required() ) {
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo get_the_password_form();
} else {
	$excerpt = qode_essential_addons_get_custom_post_type_excerpt( isset( $excerpt_length ) ? $excerpt_length : 0 );

	if ( ! empty( $excerpt ) ) { ?>
		<p itemprop="description" class="qodef-e-excerpt"><?php echo esc_html( $excerpt ); ?></p>
		<?php
	}
}
