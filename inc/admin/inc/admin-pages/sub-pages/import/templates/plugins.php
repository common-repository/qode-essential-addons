<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! empty( $demo['required_plugins'] ) ) { ?>
	<div class="qodef-required-plugins-holder">
		<h3><?php esc_html_e( 'The following plugins should be installed & activated before demo import:', 'qode-essential-addons' ); ?></h3>
		<?php
		foreach ( $demo['required_plugins'] as $plugin_key => $plugin_value ) {
			$prepared_plugin = QodeEssentialAddons_Framework_Import_Plugins::get_instance()->prepare_plugin( $plugin_key );
			?>
			<p><?php echo esc_html( $plugin_value['name'] ); ?>
				<a class="qodef-install-plugin-link" href="#" data-plugin-action="<?php echo esc_html( $prepared_plugin['status'] ); ?>" data-plugin-slug="<?php echo esc_html( $prepared_plugin['key'] ); ?>" data-plugin-action-label="<?php echo esc_html( $prepared_plugin['action_label'] ); ?>">
					<?php echo esc_html( $prepared_plugin['label'] ); ?>
				</a>
				<span class="qodef-plugin-installing-spinner">
					<span class="qodef-spinner-dot"></span>
					<span class="qodef-spinner-dot"></span>
					<span class="qodef-spinner-dot"></span>
				</span>
			</p>
		<?php } ?>
		<?php wp_nonce_field( 'qode_essential_addons_plugin_install_nonce', 'qode_essential_addons_plugin_install_nonce' ); ?>
	</div>
	<?php
}
