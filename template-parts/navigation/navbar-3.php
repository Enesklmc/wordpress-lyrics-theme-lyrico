<?php
/**
 * Two storey Navbar template
 *
 * First floor: brand - search button.
 * Second floor: links - social media buttons.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( get_theme_mod( 'show_social_with_brand_colors' ) === 1 ) {
	$is_active_brand_color = ' with-brand-colors';
} else {
	$is_active_brand_color = '';
}
?>
<nav class="navbar navbar-expand-lg d-flex flex-lg-column p-0 lyrico-navbar navbar-3">
	<div class="navbar-top px-2 px-md-3 d-flex justify-content-between justify-content-lg-between w-100 align-items-center <?php echo 'navbar-' . esc_attr( get_theme_mod( 'top_navbar_text_color', 'light' ) ); ?>">
		<?php
		get_template_part( 'template-parts/navigation/parts/navbar', 'toggler' );

		get_template_part( 'template-parts/navigation/parts/navbar', 'brand' );

		get_template_part( 'template-parts/navigation/parts/navbar', 'search-button' );
		?>
	</div><!-- .navbar-top -->

	<div class="navbar-top-secondary collapse px-3 navbar-collapse navbar-top-links w-100" id="navbar-content">
		<div class="my-2 my-lg-0 navbar-nav justify-content-center w-100 <?php echo 'navbar-' . esc_attr( get_theme_mod( 'top_secondary_navbar_text_color', 'light' ) ); ?>">
			<?php get_template_part( 'template-parts/navigation/parts/navbar', 'links' ); ?>

			<?php
			lyrico_show_social_media_icons(
				array(
					'wrap_with_ul' => true,
					'ul_class'     => 'social-media-bar justify-content-center navbar nav my-4 my-lg-0 p-0 ml-lg-2 lyrico-brand-icons',
				)
			);
			?>
		</div>
	</div><!-- .navbar-top-secondary -->
</nav> <!-- nav.navbar -->
