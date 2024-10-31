<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

$gallery_classes   = '';
$number_of_columns = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_columns_number' );
$gallery_classes  .= ! empty( $number_of_columns ) ? ' qodef-col-num--' . $number_of_columns : ' qodef-col-num--3';

$space_between_items = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_space_between_items' );
$gallery_classes    .= ! empty( $space_between_items ) ? ' qodef-gutter--' . $space_between_items : ' qodef-gutter--tiny';

if ( ! empty( $portfolio_media ) ) { ?>
	<div class="qodef-e qodef-fslightbox-popup qodef-popup-gallery qodef-grid qodef-layout--columns qodef-responsive--predefined <?php echo esc_attr( $gallery_classes ); ?>">
		<div class="qodef-grid-inner qodef-fslightbox-popup qodef-popup-gallery">
			<?php
			foreach ( $portfolio_media as $media ) {
				$media_type = $media['qodef_portfolio_media_type'];
				$media_name = 'qodef_portfolio_' . $media_type;

				$params               = array();
				$params['media_type'] = 'gallery';
				$params['media']      = $media[ $media_name ];
				// phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
				$params['unique'] = rand( 0, 999 );

				qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/media/media', $media_type, $params );
			}
			?>
		</div>
	</div>
<?php } ?>
