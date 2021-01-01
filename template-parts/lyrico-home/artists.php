<?php
/**
 * Template part for displaying Artists for lyrico-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( get_theme_mod( 'hide_home_artists_section', 0 ) === 0 ) :

	if ( get_theme_mod( 'home_artists_sorting' ) === 'popularity' ) {
		$artists_query = new WP_Query(
			array(
				'post_type'           => 'lyrico_artist',
				'post_status'         => 'publish',
				'posts_per_page'      => get_theme_mod( 'home_artists_number', 12 ),
				'meta_key'            => 'lyrico_post_views',
				'orderby'             => 'meta_value_num',
				'order'               => 'DESC',
				'ignore_sticky_posts' => 1,
			)
		);
	} else {
		$artists_query = new WP_Query(
			array(
				'post_type'      => 'lyrico_artist',
				'post_status'    => 'publish',
				'posts_per_page' => get_theme_mod( 'home_artists_number', 12 ),
				'order'          => 'DESC',
			)
		);
	}
	?>
	<?php if ( $artists_query->have_posts() ) : ?>
	<div id="home-artists" class="lyrico-module-wrapper">
		<div class="lyrico-module">
			<div class="module-header d-flex">
				<h1 id="home-featured-artists-title" class="h3">
					<a href="<?php echo esc_url( get_permalink( get_theme_mod( 'home_artists_page' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'home_artists_title', 'Featured Artists' ) ); ?></a>
				</h1>

				<div class="slider-nav d-none d-md-inline ml-auto">
					<span class="h3 home-artists-prev mx-3 slider-nav-icon"><i class="fas fa-chevron-left"></i></span>
					<span class="h3 home-artists-next slider-nav-icon"><i class="fas fa-chevron-right"></i></span>
				</div>
			</div>

			<div class="module-content home-artists-slider swiper-container">
				<div class="swiper-wrapper">
					<?php
					while ( $artists_query->have_posts() ) :
						$artists_query->the_post();
						?>
						<div class="swiper-slide">
							<?php get_template_part( 'template-parts/components/card', 'image-overlay' ); ?>
						</div>
						<?php
					endwhile;

					wp_reset_postdata();
					?>
				</div><!-- .swiper-wrapper -->
			</div><!-- .module-content -->
			<?php
			printf(
				// translators: %1$s: Url, %1$s: Button color template, %3$s: Button text.
				'<a href="%1$s" role="button" class="btn btn-%2$s d-block mt-1 w-100 mx-auto rounded-0">%3$s</a>',
				esc_url( get_permalink( get_theme_mod( 'home_artists_page' ) ) ),
				esc_attr( get_theme_mod( 'button_color_template', 'outline-dark' ) ),
				esc_html( get_theme_mod( 'home_artists_button_text', 'See all Artists' ) )
			);
			?>
		</div><!-- .lyrico-module -->
	</div><!-- .lyrico-module-wrapper -->
	<?php endif; ?>
	<?php
endif;
