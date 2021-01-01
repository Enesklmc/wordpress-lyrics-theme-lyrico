<?php
/**
 * Navbar template with modal menu
 *
 * Modal menu button - brand - search button.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>
<nav class="navbar navbar-1 navbar-top align-items-center lyrico-navbar <?php echo 'navbar-' . esc_attr( get_theme_mod( 'top_navbar_text_color', 'light' ) ); ?>">
	<div class="toggle-wrapper">
		<button class="navbar-toggler" type="button" data-toggle="modal" data-target="#navigation-modal">
			<span class="dashicons dashicons-screenoptions"></span>
		</button>
	</div>

	<?php get_template_part( 'template-parts/navigation/parts/navbar', 'brand' ); ?>

	<?php get_template_part( 'template-parts/navigation/parts/navbar', 'search-button' ); ?>
</nav>

<div class="modal fade navbar-light" id="navigation-modal" tabindex="-1" role="dialog" aria-labelledby="navigation-modalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
		<div class="modal-content modal-sm">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle"><?php esc_html_e( 'Menu', 'lyrico' ); ?></h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div><!-- .modal-header -->

			<div class="modal-body">
				<div class="navbar-nav justify-content-center w-100 text-dark">
					<?php get_template_part( 'template-parts/navigation/parts/navbar', 'links' ); ?>

					<?php
					lyrico_show_social_media_icons(
						array(
							'wrap_with_ul' => true,
							'ul_class'     => 'social-media-bar justify-content-center navbar nav p-0 mt-3 lyrico-brand-icons',
						)
					);
					?>
				</div>
			</div><!-- .modal-body -->

			<div class="modal-footer p-0">
				<button type="button" class="btn btn-light w-100 rounded-0 border-0 p-3" data-dismiss="modal"><?php esc_html_e( 'Close', 'lyrico' ); ?></button>
			</div><!-- .modal-footer -->
		</div><!-- .modal-content -->
	</div><!-- .modal-dialog -->
</div><!-- .modal -->
