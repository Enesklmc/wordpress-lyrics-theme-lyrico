<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * The template for displaying all single playlist posts
 *
 * @link https://developer.wordpress.org/themes/template-files-section/custom-post-type-template-files
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Add +1 page view each time the page is visited.
	lyrico_save_post_views( get_the_ID() );
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div itemscope itemtype="http://schema.org/MusicPlaylist">

			<?php get_template_part( 'template-parts/header/single-post', 'header' ); ?>

			<div class="container main-container">
				<div class="row">
					<div id="primary-div" class="col-md-8">
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<?php if ( ! empty( get_the_content() ) ) : ?>
								<div class="content-wrapper">
									<div class="content-single-playlist entry-content">
										<?php the_content(); ?>
									</div><!-- .entry-content -->
								</div><!-- .content-wrapper -->
								<?php endif; ?>
								<hr class="my-4">

								<div class="lyrico-post-meta d-md-flex align-items-center px-3">
									<?php lyrico_posted_meta(); ?>

									<?php get_template_part( 'template-parts/single/share-the-post' ); ?>
								</div><!-- .lyrico-post-meta -->
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->

						<?php get_template_part( 'template-parts/single/related-posts' ); ?>
					</div><!-- #primary-div -->

					<?php if ( get_theme_mod( 'single_playlist_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
					<div id="secondary-div" class="col-md-4">
						<?php
						get_sidebar();
						?>
					</div><!-- #secondary-div -->
					<?php endif; // Check if sidebar is active. ?>
				</div><!-- .row -->
			</div><!-- .main-container -->
		</div><!-- http://schema.org/MusicPlaylist -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php
endwhile;

get_footer();
