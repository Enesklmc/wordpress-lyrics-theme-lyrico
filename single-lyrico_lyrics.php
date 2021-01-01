<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * The template for displaying all single Lyrics posts
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

	$album_id      = get_post_meta( $post->ID, 'lyrico_album', true );
	$youtube_video = get_post_meta( $post->ID, 'lyrico_youtube_link', true );
	$song_writers  = get_post_meta( $post->ID, 'lyrico_song_writers', true );
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div itemscope itemtype="http://schema.org/MusicRecording">

			<?php get_template_part( 'template-parts/header/single-post', 'header' ); ?>

			<div class="container main-container">
				<div class="row">
					<div id="primary-div" class="col-md-8">
						<div class="lyrico-module-wrapper" itemprop="recordingOf" itemscope itemtype="http://schema.org/MusicComposition">
							<div class="lyrico-module">
								<?php if ( ! empty( get_the_content() ) ) : ?>
								<div class="content-wrapper" itemprop="lyrics" itemscope itemtype="http://schema.org/CreativeWork">
									<div class="content-single-lyrics entry-content" itemprop="text">
										<?php the_content(); ?>
									</div><!-- .entry-content -->
								</div><!-- .content-wrapper -->
								<?php endif; ?>

								<?php if ( ! empty( $song_writers ) ) : ?>
								<div class="lyrico-song-writers px-3 mt-4">
									<?php lyrico_implode_and_support_schema( $song_writers, '<span itemprop="lyricist">', '</span>' ); ?>
								</div>
								<?php endif; ?>

								<?php
								if ( wp_is_mobile() ) :
									echo '<hr class="my-4 d-modular-design-none">';

									get_template_part( 'template-parts/single-lyrics/embed', get_theme_mod( 'single_lyrics_fixed_embed', 'youtube' ) );

									get_template_part( 'template-parts/single-lyrics/lyrics-info' );
								endif;
								?>

								<hr class="my-4">

								<div class="lyrico-post-meta d-md-flex align-items-center px-3">
									<?php lyrico_posted_meta(); ?>
									<?php get_template_part( 'template-parts/single/share-the-post' ); ?>
								</div><!-- .lyrico-post-meta -->
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->

						<?php
						// If sidebar is not active show lyrics info and youtube video inside #primary-div.
						if ( get_theme_mod( 'single_lyrics_content_layout', 'sidebar-right' ) === 'no-sidebar' && ! wp_is_mobile() ) :
							echo '<hr class="my-4 d-modular-design-none">';

							get_template_part( 'template-parts/single-lyrics/embed', get_theme_mod( 'single_lyrics_fixed_embed', 'youtube' ) );

							get_template_part( 'template-parts/single-lyrics/lyrics-info' );
						endif; // if no sidebar.

						// If album of this lyrics is specified, load up the other songs from the album template.
						if ( ! empty( $album_id ) ) {
							get_template_part( 'template-parts/single-lyrics/other-songs-from-the-album' );
						}

						get_template_part( 'template-parts/single/related-posts' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						?>
					</div><!-- #primary-div -->

					<?php if ( get_theme_mod( 'single_lyrics_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
					<div id="secondary-div" class="col-md-4">
						<?php
						if ( ! wp_is_mobile() ) :
							get_template_part( 'template-parts/single-lyrics/embed', get_theme_mod( 'single_lyrics_fixed_embed', 'youtube' ) );

							get_template_part( 'template-parts/single-lyrics/lyrics-info' );
						endif;

						get_sidebar();
						?>
					</div><!-- #secondary-div -->
					<?php endif; // Check if sidebar is active. ?>

				</div><!-- .row -->
			</div><!-- .main-container -->
		</div><!-- http://schema.org/MusicRecording -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php
endwhile;

get_footer();
