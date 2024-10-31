<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! post_password_required() && 'no' !== $show_button ) {
	?>
	<div class="qodef-e-read-more" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_button_styles( $params ) ); ?>>
		<a itemprop="url" class="qodef-theme-button qodef--simple qodef--with-icon" href="<?php the_permalink(); ?>">
			<span class="qodef-theme-button-text"><?php esc_html_e( 'View project', 'qode-essential-addons' ); ?></span>
			<?php qode_essential_addons_render_svg_icon( 'button-arrow', 'qodef-theme-button-icon' ); ?>
		</a>
	</div>
<?php } ?>
