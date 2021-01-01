<?php
/**
 * Template part for displaying Posts for lyrico-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( get_theme_mod( 'hide_home_news_section', 0 ) === 0 ) :

	$query = new WP_Query(
		array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => get_theme_mod( 'home_news_number', 5 ),
			'order'          => 'DESC',
		)
	);
	?>
	<?php if ( $query->have_posts() ) : ?>
	<div id="home-news" class="lyrico-module-wrapper">
		<div class="lyrico-module">
			<div class="module-header">
				<h1 id="home-blog-posts-title" class="h3"><?php echo esc_html( get_theme_mod( 'home_news_title', 'News' ) ); ?></h1>
			</div>

			<div class="module-content">
				<ul class="list-unstyled no-border-last-child mb-0">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<li class="py-3 border-bottom position-relative">
						<div class="media align-items-center">
							<div class="media-body">
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="stretched-link"><?php the_title(); ?></a>
							</div>
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'smaller-thumbnail', array( 'class' => 'ml-2 rounded' ) ); }
								?>
						</div>
					</li>
					<?php
				endwhile;

				wp_reset_postdata();
				?>
				</ul>

				<a href="<?php echo esc_url( get_permalink( get_theme_mod( 'home_news_page' ) ) ); ?>" role="button" class="btn btn-<?php echo esc_attr( get_theme_mod( 'button_color_template', 'outline-dark' ) ); ?> d-block mt-1 w-100 mx-auto rounded-0">
					<?php echo esc_html( get_theme_mod( 'home_news_button_text', 'See all News' ) ); ?>
				</a>
			</div><!-- .module-content -->
		</div><!-- .lyrico-module -->
	</div><!-- .lyrico-module-wrapper -->
	<?php endif; ?>
	<?php
endif;
