<?php
/**
 * Template part for displaying Popular Lyrics for lyrico-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( get_theme_mod( 'hide_home_popular_lyrics_section', 0 ) === 0 ) :

	$lyrics_query = new WP_Query(
		array(
			'post_type'           => 'lyrico_lyrics',
			'posts_per_page'      => get_theme_mod( 'home_popular_lyrics_number', 10 ),
			'post_status'         => 'publish',
			'meta_key'            => 'lyrico_post_views',
			'orderby'             => 'meta_value_num',
			'order'               => 'DESC',
			'ignore_sticky_posts' => 1,
		)
	);
	?>
	<?php if ( $lyrics_query->have_posts() ) : ?>
	<div id="home-popular-lyrics" class="lyrico-module-wrapper">
		<div class="lyrico-module">
			<div class="module-header">
				<h1 id="home-popular-lyrics-title" class="h3"><?php echo esc_html( get_theme_mod( 'home_popular_lyrics_title', 'Popular Lyrics' ) ); ?></h1>
			</div>

			<div class="module-content">
				<ul class="list-unstyled popular-lyrics-list no-border-last-child m-0">
				<?php
				$position = 1;
				while ( $lyrics_query->have_posts() ) :
					$lyrics_query->the_post();
					?>
					<li class="mb-3">
						<?php set_query_var( 'media_order', $position ); ?>
						<?php get_template_part( 'template-parts/components/media', 'ordered' ); ?>
						<?php $position++; ?>
					</li>
					<?php
				endwhile;

				wp_reset_postdata();
				?>
				</ul>
			</div><!-- .module-content -->
		</div><!-- .lyrico-module -->
	</div><!-- .lyrico-module-wrapper -->
	<?php endif; ?>
	<?php
endif;

