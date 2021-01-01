<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * The template for displaying all single Artist posts.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/custom-post-type-template-files
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Add +1 page view every time visiting the page.
	lyrico_save_post_views( get_the_ID() );
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div itemscope itemtype="http://schema.org/MusicGroup">

			<?php get_template_part( 'template-parts/header/single-post', 'header' ); ?>

			<div class="container main-container">
				<div class="row">
					<div id="primary-div" class="col-md-8">
						<?php if ( ! empty( get_the_content() ) ) : ?>
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<div class="content-single-artist entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->
						<?php endif; ?>

						<?php if ( get_theme_mod( 'single_artist_content_layout', 'sidebar-right' ) === 'no-sidebar' ) : ?>
								<?php get_template_part( 'template-parts/single-artist/artist-info-table' ); ?>
						<?php endif; // If sidebar is not active show artist info inside #primary-div. ?>

						<?php
						get_template_part( 'template-parts/single-artist/popular-lyrics-of-the-artist' );

						get_template_part( 'template-parts/single-artist/albums-and-lyrics' );

						get_template_part( 'template-parts/single-artist/lyrics-without-album' );

						get_template_part( 'template-parts/single/related-posts' );
						?>
					</div><!-- #primary-div -->

					<?php if ( get_theme_mod( 'single_artist_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
					<div id="secondary-div" class="col-md-4">
						<?php get_template_part( 'template-parts/single-artist/artist-info-table' ); ?>

						<?php get_sidebar(); ?>
					</div><!-- #secondary-div -->
					<?php endif; // Check if sidebar is active. ?>
				</div><!-- .row -->
			</div><!-- .main-container -->
		</div><!-- http://schema.org/MusicGroup -->
	</article>

	<?php
endwhile;

get_footer();
