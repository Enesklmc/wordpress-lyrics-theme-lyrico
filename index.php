<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();
?>

<?php if ( ( is_home() && ! is_front_page() ) || is_archive() ) : ?>

	<?php get_template_part( 'template-parts/header/page', 'header' ); ?>

<?php else : ?>

<div class="container-fluid page-header-container lyrico-site-header <?php echo 'lyrico-gradient-' . esc_attr( get_theme_mod( 'header_background_template', 'midnight-city' ) ); ?>">
	<div class="position-relative py-3 py-sm-4 py-lg-5">
		<header class="py-5 px-4 px-md-5 d-flex">
			<h1 class="my-0 mx-auto"><?php echo esc_html__( 'Posts', 'lyrico' ); ?></h1>
		</header>
	</div>
</div><!-- .page-header-container -->

<?php endif; ?>

<div class="container main-container">
	<div class="row">
		<div id="primary-div" class="col-md-8">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();

					if ( is_sticky() ) {
						get_template_part( 'template-parts/components/card', 'sticky-post' );
					} else {
						get_template_part( 'template-parts/components/card', 'post' );
					}

				endwhile;

				lyrico_pagination(
					array(
						'wrap_before' => '<div class="lyrico-module-wrapper"><div class="lyrico-module">',
						'wrap_after'  => '</div></div>',
					)
				);
			else :

				get_template_part( 'template-parts/content/content', 'none' );

			endif;
			?>
		</div><!-- #primary-div -->

		<?php if ( get_theme_mod( 'latest_posts_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
		<div id="secondary-div" class="col-md-4">
			<?php get_sidebar(); ?>
		</div> <!-- #secondary-div -->
		<?php endif; ?>
	</div> <!-- .row -->
</div> <!-- .main-container -->

<?php
get_footer();
