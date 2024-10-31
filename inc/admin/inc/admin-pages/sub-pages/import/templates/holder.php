<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-page-v4-essential-addons qodef-admin-page-v4 qodef-dashboard-admin qodef-dashboard-addons-import">
	<?php $this_object->get_header(); ?>
	<div class="qodef-admin-demos-content qodef-admin-content qodef-admin-grid qodef-admin-layout--columns <?php echo esc_attr( $holder_classes ); ?>">
		<?php $this_object->get_content(); ?>
	</div>
	<?php if ( ! defined( 'QODE_ESSENTIAL_ADDONS_PREMIUM_VERSION' ) ) { ?>
	<div class="qodef-demo-upgrade">
		<div class="qodef-demo-upgrade-message">
			<div class="qodef-demo-upgrade-message-close">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="11px" height="11px" viewBox="0 0 10.523 10.523" enable-background="new 0 0 11 11" xml:space="preserve">
					<g>
						<path d="M0.275,9.26l3.953-3.998L0.275,1.264c-0.359-0.329-0.367-0.666-0.022-1.011c0.344-0.344,0.681-0.337,1.011,0.022
							l3.998,3.953L9.26,0.275c0.329-0.359,0.666-0.366,1.011-0.022c0.344,0.345,0.337,0.682-0.022,1.011L6.295,5.262l3.953,3.998
							c0.359,0.33,0.366,0.667,0.022,1.011c-0.345,0.345-0.682,0.337-1.011-0.022L5.262,6.295l-3.998,3.953
							c-0.33,0.359-0.667,0.367-1.011,0.022C-0.092,9.927-0.084,9.59,0.275,9.26z"/>
					</g>
				</svg>
			</div>
			<p><?php esc_html_e( 'This demo is a part of Premium Qi Theme & Addons package.', 'qode-essential-addons' ); ?></p>
			<p><?php esc_html_e( 'Upgrade now to get all demos and options.', 'qode-essential-addons' ); ?></p>
			<a class="qodef-btn qodef-btn-solid-red" target="_blank" href="https://qodeinteractive.com/products/plugins/qi-theme/"><?php esc_html_e( 'Upgrade Now', 'qode-essential-addons' ); ?></a>
		</div>
	</div>
	<?php } ?>
</div>
