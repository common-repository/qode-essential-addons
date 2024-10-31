<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-e-info-item qodef-e-info-category">
	<?php qode_essential_addons_render_svg_icon( 'category', 'qodef-e-info-item-icon' ); ?>
	<?php the_category( '<span class="qodef-category-separator"></span>' ); ?>
</div>
