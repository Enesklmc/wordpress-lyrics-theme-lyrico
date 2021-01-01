<?php
/**
 * Template part for displaying Latest Lyrics for lyrico-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( get_theme_mod( 'hide_home_latest_lyrics_section', 0 ) === 0 ) :
	$lyrics_query = new WP_Query(
		array(
			'post_type'      => 'lyrico_lyrics',
			'post_status'    => 'publish',
			'posts_per_page' => get_theme_mod( 'home_latest_lyrics_number', 8 ),
		)
	);
	?>
	<?php if ( $lyrics_query->have_posts() ) : ?>
	<div id="home-latest-lyrics" class="lyrico-module-wrapper">
		<div class="lyrico-module">
			<div class="module-header">
				<h1 id="home-latest-lyrics-title" class="h3"><?php echo esc_html( get_theme_mod( 'home_latest_lyrics_title', 'Latest Lyrics' ) ); ?></h1>
			</div>

			<div class="module-content">
				<div class="row half-gutters">
				<?php
				while ( $lyrics_query->have_posts() ) :
					$lyrics_query->the_post();
					?>
					<div class="col-lg-6">
						<?php get_template_part( 'template-parts/components/media', 'thumbnail-text' ); ?>
					</div>
					<?php
				endwhile;

				wp_reset_postdata();
				?>
				</div>
			</div><!-- .module-content -->
		</div><!-- .lyrico-module -->
	</div><!-- .lyrico-module-wrapper -->
	<?php endif; ?>
	<?php
endif;
