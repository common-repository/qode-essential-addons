<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$categories = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

if ( ! empty( $categories ) && 'no' !== $show_category ) { ?>
	<div class="qodef-e-info-category" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_post_info_styles( $params ) ); ?>>
		<?php echo get_the_term_list( get_the_ID(), 'portfolio-category', '', '<span class="qodef-category-separator"></span>' ); ?>
	</div>
<?php } ?>
