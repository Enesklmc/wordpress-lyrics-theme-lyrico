<?php
/**
 * Simple Navbar template
 *
 * Brand - links - social media buttons - search button
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>
<nav class="px-3 navbar navbar-2 navbar-expand-lg navbar-top navbar-2 align-items-center lyrico-navbar <?php echo 'navbar-' . esc_attr( get_theme_mod( 'top_navbar_text_color', 'light' ) ); ?>">
	<div class="mr-lg-2">
		<?php get_template_part( 'template-parts/navigation/parts/navbar', 'brand' ); ?>
	</div>

	<?php get_template_part( 'template-parts/navigation/parts/navbar', 'toggler' ); ?>

	<div class="collapse navbar-collapse navbar-top-links py-3 py-lg-0" id="navbar-content">
		<?php get_template_part( 'template-parts/navigation/parts/navbar', 'links' ); ?>

		<div class="ml-lg-auto d-lg-flex align-items-center">
			<?php
			lyrico_show_social_media_icons(
				array(
					'wrap_with_ul' => true,
					'ul_class'     => 'social-media-bar navbar nav justify-content-center p-0 ml-lg-auto mr-lg-2 lyrico-brand-icons',
				)
			);
			?>

			<?php get_template_part( 'template-parts/navigation/parts/navbar', 'search-button' ); ?>
		</div>
	</div>
</nav>
