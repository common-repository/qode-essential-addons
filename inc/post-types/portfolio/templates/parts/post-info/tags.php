<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$tags = wp_get_post_terms( get_the_ID(), 'portfolio-tag' );

if ( is_array( $tags ) && count( $tags ) ) { ?>
	<div class="qodef-e qodef-info--tag">
		<p class="qodef-e-title qodef-style--meta"><?php esc_html_e( 'tag', 'qode-essential-addons' ); ?></p>
		<div class="qodef-e-tags"><?php echo get_the_term_list( get_the_ID(), 'portfolio-tag', '', '<span class="qodef-category-separator"></span>' ); ?></div>
	</div>
<?php } ?>
