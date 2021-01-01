<?php
/**
 * Template part for displaying Search form for lyrico-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$post_type_class = 'lyrico-post-type-' . str_replace( '_', '-', get_post_type() );

if ( get_theme_mod( 'hide_home_search_section', 0 ) === 0 ) :
	?>
	<div data-template="<?php echo 'lyrico-gradient-' . esc_attr( get_theme_mod( 'header_background_template', 'midnight-city' ) ); ?>" class="lyrico-site-header single-header-container <?php echo esc_attr( $post_type_class ); ?> container-fluid p-0 <?php echo 'lyrico-gradient-' . esc_attr( get_theme_mod( 'header_background_template', 'midnight-city' ) ); ?>">
		<div class="position-relative px-lg-5">
			<div id="home-search">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div><!-- .single-header-container -->
	<?php
endif;
