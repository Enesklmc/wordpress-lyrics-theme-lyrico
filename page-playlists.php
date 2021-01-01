<?php
/**
 * Template Name: Playlists
 *
 * The template for displaying featured playlists and all single playlist posts
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();

if ( get_theme_mod( 'page_playlists_content_layout', 'no-sidebar' ) !== 'no-sidebar' ) :
	$card_column = 'col-6 col-sm-4 col-lg-3';
else :
	$card_column = 'col-6 col-sm-4 col-md-3 col-lg-2';
endif;

$featured_playlists_args = array(
	'post_type'           => 'lyrico_playlist',
	'meta_key'            => 'lyrico_post_views',
	'orderby'             => 'meta_value_num',
	'post_status'         => 'publish',
	'posts_per_page'      => get_theme_mod( 'page_playlists_featured_playlists_number', 8 ),
	'ignore_sticky_posts' => 1,
);

$featured_playlists_query = new WP_Query( $featured_playlists_args );

$all_playlists_args = array(
	'post_type'      => 'lyrico_playlist',
	'post_status'    => 'publish',
	'posts_per_page' => get_theme_mod( 'page_playlists_all_playlists_number', 24 ),
);

$all_playlists_query = new WP_Query( $all_playlists_args );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php get_template_part( 'template-parts/header/page', 'header' ); ?>

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
										<div class="content-playlist entry-content">
											<?php the_content(); ?>
										</div><!-- .entry-content -->
									</div><!-- .lyrico-module -->
								</div><!-- .lyrico-module-wrapper -->
								<?php
							endif;
						endwhile;
					endif;
					?>
					<?php if ( get_theme_mod( 'page_playlists_hide_featured_playlists', 0 ) === 0 ) : ?>
						<?php if ( $featured_playlists_query->have_posts() ) : ?>
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<div class="module-header d-flex">
									<h2 class="h3"><?php esc_html_e( 'Popular Playlists', 'lyrico' ); ?></h2>
									<div class="slider-nav ml-auto d-none d-md-inline">
										<span class="h3 page-prev mx-1 slider-nav-icon"><span class="lyrico-dashicon dashicons-arrow-left-alt2"></span></span>
										<span class="h3 page-next slider-nav-icon"><span class="lyrico-dashicon dashicons-arrow-right-alt2"></span></span>
									</div>
								</div><!-- .module-header -->

								<div class="module-content page-slider swiper-container">
									<div class="swiper-wrapper">
										<?php
										while ( $featured_playlists_query->have_posts() ) :
											$featured_playlists_query->the_post();
											?>

											<div class="swiper-slide">
												<?php get_template_part( 'template-parts/components/card', get_theme_mod( 'page_playlists_featured_playlists_style', 'image-overlay' ) ); ?>
											</div>

											<?php
										endwhile;
										wp_reset_postdata();
										?>
									</div><!-- .swiper-wrapper -->
								</div><!-- .module-content -->
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( $all_playlists_query->have_posts() ) : ?>
					<div class="lyrico-module-wrapper">
						<div class="lyrico-module">
							<?php if ( get_theme_mod( 'page_playlists_hide_featured_playlists', 0 ) === 0 ) : ?>
							<div class="module-header">
								<h2 class="h3"><?php esc_html_e( 'Featured Playlists', 'lyrico' ); ?></h2>
							</div><!-- .module-header -->
							<?php endif; ?>

							<div class="module-content">
								<div class="row no-gutters all-posts-container with-ajax-load-more">
									<?php
									while ( $all_playlists_query->have_posts() ) :
										$all_playlists_query->the_post();
										?>

										<div class="<?php echo esc_attr( $card_column ); ?> post-component-wrapper">
											<?php get_template_part( 'template-parts/components/card', get_theme_mod( 'page_playlists_all_playlists_style', 'image-overlay' ) ); ?>
										</div>

										<?php
									endwhile;
									wp_reset_postdata();
									?>
								</div><!-- .row -->
							</div><!-- .module-content -->

							<?php if ( $all_playlists_query->max_num_pages > 1 ) : ?>
							<div class="load-more-container container text-center">
								<button data-total-pages="<?php echo esc_attr( $all_playlists_query->max_num_pages ); ?>" data-page="1" data-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" class="btn lyrico-load-more mx-auto">
									<i class="load-more-icon fas fa-sync-alt"></i>
									<span class="load-more-text"><?php esc_html_e( 'Load More', 'lyrico' ); ?></span>
								</button>
							</div><!-- .load-more-container -->
							<?php endif; ?>
						</div><!-- .lyrico-module -->
					</div><!-- .lyrico-module-wrapper -->
					<?php endif; ?>
				</div><!-- #primary-div -->

				<?php if ( get_theme_mod( 'page_playlists_content_layout', 'no-sidebar' ) !== 'no-sidebar' ) : ?>
				<div id="secondary-div" class="col-md-4">
					<?php get_sidebar(); ?>
				</div><!-- #secondary-div -->
				<?php endif; ?>
			</div><!-- .row -->
		</div><!-- .main-container -->
	</article>

<?php
get_footer();
