<?php
/**
 * Template Name: Albums
 *
 * The template for displaying featured albums and all single album posts
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();

if ( get_theme_mod( 'page_albums_all_albums_style', 'card-image-overlay' ) === 'list-item-simple' ) {
	$card_column = 'col-sm-6 col-xl-4 px-2';
} else {
	if ( get_theme_mod( 'page_albums_content_layout', 'no-sidebar' ) !== 'no-sidebar' ) :
		$card_column = 'col-6 col-sm-4 col-lg-3';
	else :
		$card_column = 'col-6 col-sm-4 col-md-3 col-lg-2';
	endif;
}
$the_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$all_albums_args = array(
	'post_type'      => 'lyrico_album',
	'post_status'    => 'publish',
	'posts_per_page' => get_theme_mod( 'page_albums_all_albums_number', 24 ),
	'paged'          => $the_paged,
	'orderby'        => 'title',
	'order'          => 'ASC',
);

$all_albums_query = new WP_Query( $all_albums_args );
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
										<div class="content-album entry-content">
											<?php the_content(); ?>
										</div><!-- .entry-content -->
									</div><!-- .lyrico-module -->
								</div><!-- .lyrico-module-wrapper -->
								<?php
							endif;
						endwhile;
					endif;
					?>
					<?php if ( get_theme_mod( 'page_albums_hide_featured_albums', 0 ) === 0 ) : ?>
						<?php
						$featured_albums_args = array(
							'post_type'           => 'lyrico_album',
							'posts_per_page'      => get_theme_mod( 'page_albums_featured_albums_number', 8 ),
							'post_status'         => 'publish',
							'meta_key'            => 'lyrico_post_views',
							'orderby'             => 'meta_value_num',
							'ignore_sticky_posts' => 1,
						);

						$featured_albums_query = new WP_Query( $featured_albums_args );
						?>

						<?php if ( $featured_albums_query->have_posts() ) : ?>
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<div class="module-header d-flex">
									<h2 class="h3"><?php esc_html_e( 'Featured Albums', 'lyrico' ); ?></h2>
									<div class="slider-nav d-none d-md-inline ml-auto">
										<span class="h3 page-prev mx-3 slider-nav-icon"><i class="fas fa-chevron-left"></i></span>
										<span class="h3 page-next slider-nav-icon"><i class="fas fa-chevron-right"></i></span>
									</div>
								</div><!-- .module-header -->

								<div class="module-content page-slider swiper-container">
									<div class="swiper-wrapper">
									<?php
									while ( $featured_albums_query->have_posts() ) :
										$featured_albums_query->the_post();
										?>
										<div class="swiper-slide">
											<?php get_template_part( 'template-parts/components/card', get_theme_mod( 'page_albums_featured_albums_style', 'image-overlay' ) ); ?>
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

					<?php if ( $all_albums_query->have_posts() ) : ?>
					<div class="lyrico-module-wrapper">
						<div class="lyrico-module">
							<?php if ( get_theme_mod( 'page_albums_hide_featured_albums', 0 ) === 0 ) : ?>
							<div class="module-header">
								<h2 class="h3"><?php esc_html_e( 'All Albums', 'lyrico' ); ?></h2>
							</div><!-- .module-header -->
							<?php endif; ?>

							<div class="module-content">
								<div class="row no-gutters all-posts-container">
									<?php
									while ( $all_albums_query->have_posts() ) :
										$all_albums_query->the_post();
										?>
										<div class="<?php echo esc_attr( $card_column ); ?> post-component-wrapper">
											<?php get_template_part( 'template-parts/components/' . get_theme_mod( 'page_albums_all_albums_style', 'card-image-overlay' ) ); ?>
										</div>
										<?php
									endwhile;
									wp_reset_postdata();
									?>
								</div><!-- .row -->
							</div><!-- .module-content -->

							<?php lyrico_pagination( array( 'total' => $all_albums_query->max_num_pages ) ); ?>
						</div><!-- .lyrico-module -->
					</div><!-- lyrico-module-wrapper -->
					<?php endif; ?>
				</div><!-- #primary-div -->

				<?php if ( get_theme_mod( 'page_albums_content_layout', 'no-sidebar' ) !== 'no-sidebar' ) : ?>
				<div id="secondary-div" class="col-md-4">
					<?php get_sidebar(); ?>
				</div><!-- #secondary-div -->
				<?php endif; ?>
			</div><!-- .row -->
		</div><!-- .main-container -->
	</article>

<?php
get_footer();
