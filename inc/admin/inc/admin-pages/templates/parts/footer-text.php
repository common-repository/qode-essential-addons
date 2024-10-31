<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<?php esc_html_e( 'We hope you\'re having a great time using the Qi Addons for Elementor', 'qode-essential-addons' ); ?>
<br/>
<?php
printf(
// translators: 1. WordPress plugin url.
	esc_html__( 'Leave a %s let us know about your experience!', 'qode-essential-addons' ),
	'<a href="https://wordpress.org/plugins/qode-essential-addons/#reviews">' . esc_html__( 'rating', 'qode-essential-addons' ) . '</a>'
);
