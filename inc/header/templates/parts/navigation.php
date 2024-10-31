<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( has_nav_menu( 'main-navigation' ) ) :
	?>
	<nav class="qodef-header-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'qode-essential-addons' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main-navigation',
				'container'      => '',
				'link_before'    => '<span class="qodef-menu-item-text">',
				'link_after'     => '</span>',
			)
		);
		?>
	</nav>
<?php endif; ?>
