<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div id="qodef-fullscreen-area">
	<?php
	qode_essential_addons_template_part( 'fullscreen-menu', 'templates/full-screen-close' );
	?>
	<?php if ( $fullscreen_menu_in_grid ) { ?>
	<div class="qodef-content-grid">
	<?php } ?>

		<div id="qodef-fullscreen-area-inner">
			<?php if ( has_nav_menu( 'fullscreen-menu-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
				<nav class="qodef-fullscreen-menu">
					<?php
					do_action( 'qode_essential_addons_before_fullscreen_menu_navigation' );

					// Set main navigation menu as vertical if vertical navigation is not set.
					$theme_location = has_nav_menu( 'fullscreen-menu-navigation' ) ? 'fullscreen-menu-navigation' : 'main-navigation';

					wp_nav_menu(
						array(
							'theme_location' => $theme_location,
							'container'      => '',
							'link_before'    => '<span class="qodef-menu-item-text">',
							'link_after'     => '</span>',
						)
					);

					do_action( 'qode_essential_addons_after_fullscreen_menu_navigation' );
					?>
				</nav>
			<?php } ?>

			<?php do_action( 'qode_essential_addons_filter_fullscreen_menu_widget_area' ); ?>

		</div>

	<?php if ( $fullscreen_menu_in_grid ) { ?>
	</div>
	<?php } ?>
</div>
