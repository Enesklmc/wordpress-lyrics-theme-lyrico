<?php
/**
 * Template Name: Lyrico Homepage
 *
 * The template for homepage
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();
?>

<?php get_template_part( 'template-parts/lyrico-home/search' ); ?>

<div class="container main-container">
	<div class="row">
		<div id="primary-div" class="col-md-8">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					if ( ! empty( get_the_content() ) ) :
						?>
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<div class="content-home entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->
						<?php
					endif;
				endwhile;
			endif;
			?>

			<?php get_template_part( 'template-parts/lyrico-home/latest-lyrics' ); ?>

			<?php get_template_part( 'template-parts/lyrico-home/playlists' ); ?>

			<?php get_template_part( 'template-parts/lyrico-home/artists' ); ?>

			<?php get_template_part( 'template-parts/lyrico-home/albums' ); ?>

			<?php if ( get_theme_mod( 'home_content_layout', 'sidebar-right' ) === 'no-sidebar' ) : ?>
				<?php get_template_part( 'template-parts/lyrico-home/popular-lyrics' ); ?>

				<?php get_template_part( 'template-parts/lyrico-home/posts' ); ?>
			<?php endif; ?>
		</div><!-- .col-md-8 -->

		<?php if ( get_theme_mod( 'home_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
		<div id="secondary-div" class="col-md-4">
			<?php
			if ( is_active_sidebar( 'sidebar-home' ) ) {
				dynamic_sidebar( 'sidebar-home' );
			}
			?>

			<?php get_template_part( 'template-parts/lyrico-home/popular-lyrics' ); ?>

			<?php get_template_part( 'template-parts/lyrico-home/posts' ); ?>
		</div><!-- .col-md-4 .sidebar -->
		<?php endif; ?>
	</div><!-- .row -->
</div><!-- .main-container -->
<?php
get_footer();

