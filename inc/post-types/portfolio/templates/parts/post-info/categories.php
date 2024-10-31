<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$categories = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

if ( is_array( $categories ) && count( $categories ) ) { ?>
	<div class="qodef-e qodef-info--category">
		<p class="qodef-e-title qodef-style--meta"><?php esc_html_e( 'category', 'qode-essential-addons' ); ?></p>
		<div class="qodef-e-categories"><?php echo get_the_term_list( get_the_ID(), 'portfolio-category', '', '<span class="qodef-category-separator"></span>' ); ?></div>
	</div>
<?php } ?>
