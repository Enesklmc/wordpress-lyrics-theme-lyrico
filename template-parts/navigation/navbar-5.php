<?php
/**
 * Two storey Navbar template with swiper slider links
 *
 * First floor: brand.
 * Second floor: slider( links - social media buttons ) - search button.
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
<nav class="navbar d-flex flex-column p-0 lyrico-navbar navbar-5 navbar-with-slider">
	<div class="navbar-top px-2 px-md-3 d-flex w-100 <?php echo 'navbar-' . esc_attr( get_theme_mod( 'top_navbar_text_color', 'light' ) ); ?>">
		<div class="mx-auto">
			<?php get_template_part( 'template-parts/navigation/parts/navbar', 'brand' ); ?>
		</div>
	</div>

	<div class="navbar w-100 navbar-expand px-2 px-md-3 navbar-top-secondary justify-content-center d-flex <?php echo 'navbar-' . esc_attr( get_theme_mod( 'top_secondary_navbar_text_color', 'light' ) ); ?>" id="navbar-content">
		<div class="pr-2 overflow-hidden swiper-navbar-slider swiper-container m-0">
			<ul class="d-flex align-items-center swiper-wrapper navbar-nav social-media-bar lyrico-brand-icons<?php echo esc_attr( $is_active_brand_color ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top',
					'depth'          => 2,
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
					'walker'         => new WP_Bootstrap_Navwalker(),
				)
			);

			lyrico_show_social_media_icons();
			?>
			</ul>
		</div>

		<div class="pl-2 search-button-wrapper">
			<?php get_template_part( 'template-parts/navigation/parts/navbar', 'search-button' ); ?>
		</div>
	</div>
</nav> <!-- nav.navbar -->
