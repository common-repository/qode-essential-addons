<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$show_banner = apply_filters( 'qode_essential_addons_filter_options_upgrade_banner', true );
	if ( $show_banner ) {
		$button_text = apply_filters( 'qode_essential_addons_filter_welcome_premium_box_link_text', esc_html__( 'Upgrade Now', 'qode-essential-addons' ) );
		$button_link = apply_filters( 'qode_essential_addons_filter_welcome_premium_box_link', 'https://qodeinteractive.com/products/plugins/qi-theme/' );
		$button_link = add_query_arg(
			array(
				'utm_source'   => 'dash',
				'utm_medium'   => 'qodeessential',
				'utm_campaign' => 'welcome',
			),
			$button_link
	);
?>
	<div class="qodef-section-box qodef-section-qi-theme-premium">
		<div class="qodef-section-box-content">
			<h2>
				<?php esc_html_e( 'Qi Theme Premium', 'qode-essential-addons' ); ?>
				<svg class="qodef-star" xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10">
					<path d="m5.5 0 1.513 3.538L11 3.82 7.947 6.288 8.9 10 5.5 7.988 2.1 10l.952-3.712L0 3.82l3.987-.282Z"/>
				</svg>
			</h2>
			<p class="qodef-large"><?php esc_html_e( 'With more demos & enhanced options', 'qode-essential-addons' ); ?></p>
			<a class="qodef-btn qodef-btn-solid" target="_blank" href="<?php echo esc_url( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
		</div>
		<div class="qodef-section-box-image">
			<img src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/assets/img/qi-theme-premium.png' ); ?>" alt="<?php esc_attr_e( 'Import Demos', 'qode-essential-addons' ); ?>" />
		</div>
	</div>
<?php } ?>