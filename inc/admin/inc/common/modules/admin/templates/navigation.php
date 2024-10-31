<?php
if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-tabs-navigation-wrapper">
	<div class="qodef-tabs-navigation-wrapper-inner">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<?php
					foreach ( $pages as $page_object ) {
						$page_slug       = $page_object->get_slug();
						$page_title      = $page_object->get_title();
						$section_slug    = empty( $page_slug ) ? $options_name : $options_name . '_' . $page_slug;
						$dependency      = $page_object->get_dependency() ?? array();
						$dependency_data = array();

						$item_class   = array();
						$item_class[] = 'qodef-' . esc_attr( $page_slug );

						if ( ! empty( $dependency ) ) {
							$show     = array_key_exists( 'show', $dependency ) ? qode_essential_addons_framework_return_dependency_options_array( $options_name, 'admin', $dependency['show'], true ) : array();
							$hide     = array_key_exists( 'hide', $dependency ) ? qode_essential_addons_framework_return_dependency_options_array( $options_name, 'admin', $dependency['hide'] ) : array();
							$relation = array_key_exists( 'relation', $dependency ) ? $dependency['relation'] : 'and';

							$item_class[] = 'qodef-dependency-holder';
							$item_class[] = qode_essential_addons_framework_return_dependency_classes( $show, $hide );

							$dependency_data = qode_essential_addons_framework_return_dependency_data( $show, $hide, $relation );
						}

						$dependency_data['data-options-url'] = esc_url_raw(
							add_query_arg(
								array(
									'page' => QODE_ESSENTIAL_ADDONS_MENU_NAME,
								),
								admin_url( 'admin.php' )
							)
						);
						?>
						<li class="nav-item <?php echo esc_attr( implode( ' ', $item_class ) ); ?>" <?php echo qode_essential_addons_framework_get_inline_attrs( $dependency_data, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<span class="nav-link" data-section="<?php echo esc_attr( $section_slug ); ?>">
									<?php if ( $page_object->get_icon() !== '' && $use_icons ) { ?>
										<i class="<?php echo esc_attr( $page_object->get_icon() ); ?> qodef-tooltip qodef-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr( $page_title ); ?>"></i>
									<?php } ?>
								<span><?php echo esc_html( $page_title ); ?></span>
							</span>
						</li>
					<?php } ?>
				</ul>
			</div>
		</nav>
	</div>
</div>
