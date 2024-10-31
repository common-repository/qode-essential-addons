<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-e-info-item qodef-e-info-author">
	<a itemprop="author" class="qodef-e-info-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
		<?php qode_essential_addons_render_svg_icon( 'author', 'qodef-e-info-item-icon' ); ?>
		<?php the_author_meta( 'display_name' ); ?>
	</a>
</div>
