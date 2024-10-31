<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-admin-footer">
	<div class="qodef-admin-footer-logo">
		<img width="55" src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/assets/img/footer-logo-qode-interactive.png' ); ?>" alt="<?php esc_attr_e( 'Qode Interactive Logo', 'qode-essential-addons' ); ?>"/>
	</div>
	<div class="qodef-admin-footer-text">
		<h3><?php esc_html_e( 'Qode Interactive', 'qode-essential-addons' ); ?></h3>
		<p><?php esc_html_e( 'Copyright &copy; 2021 Qode Interactive, All rights reserved', 'qode-essential-addons' ); ?></p>
	</div>
</div>
