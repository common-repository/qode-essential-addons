<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( isset( $demo['demo_image_url'] ) ) {
	$single_image_class = isset( $params['single_image_class'] ) ? $params['single_image_class'] : 'qodef-single-image';
	?>
	<div class="<?php echo esc_attr( $single_image_class ); ?>"><img src="<?php echo esc_url( $demo['demo_image_url'] ); ?>" alt="<?php echo esc_attr( $demo['demo_name'] ); ?>"/></div>
	<?php
}
