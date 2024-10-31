<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty( $portfolio_list_image ) || has_post_thumbnail();

if ( $has_image ) {
	$image_dimension = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
	?>
	<div class="qodef-e-media-image">
		<a itemprop="url" href="<?php the_permalink(); ?>">
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo qode_essential_addons_get_list_shortcode_item_image( $image_dimension, 'masonry' === $params['behavior'] ? $portfolio_list_image : '' );
			?>
			<?php if ( ! empty( $overlay_color ) || ! empty( $overlay_hover_color ) ) { ?>
				<span class="qodef-e-media-image-overlay" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_overlay_styles( $params ) ); ?>></span>
			<?php } ?>
		</a>
	</div>
<?php } ?>
