<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * The template for displaying all single Album posts.
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

	$primary_artist = get_post_meta( $post->ID, 'lyrico_artist', true );

	$args = array(
		'post_type'      => 'lyrico_lyrics',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_query'     => array(
			'relation'       => 'AND',
			'album_clause'   => array(
				'key'   => 'lyrico_album',
				'value' => get_the_ID(),
			),
			'order_in_album' => array(
				'key'     => 'lyrico_order_in_album',
				'compare' => 'EXIST',
				'type'    => 'NUMERIC',
			),
		),
		'orderby'        => 'order_in_album',
		'order'          => 'ASC',
	);

	$query = new WP_Query( $args );
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div itemscope itemtype="http://schema.org/MusicAlbum">

			<?php get_template_part( 'template-parts/header/single-post', 'header' ); ?>

			<div class="container main-container">
				<div class="row">
					<div id="primary-div" class="col-md-8">
						<?php if ( ! empty( get_the_content() ) ) : ?>
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<div class="content-single-album entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->
						<?php endif; ?>
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<div class="module-header">
									<h2 class="h3"><?php esc_html_e( 'Lyrics List', 'lyrico' ); ?></h2>
								</div><!-- .module-header -->

								<div itemprop="track" itemscope itemtype="http://schema.org/ItemList">
									<meta itemprop="numberOfItems" content="<?php echo esc_attr( $query->found_posts ); ?>">
									<ul class="list-unstyled album-lyrics-list no-border-last-child mb-0">
										<?php
										$position = 1;
										while ( $query->have_posts() ) :
											$query->the_post();
											?>
											<li class="position-relative border-bottom py-2 py-md-3" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
												<meta itemprop="position" content="<?php echo intval( $position ); ?>">

												<a href="<?php echo esc_url( get_permalink() ); ?>" class="d-block primary-media-title stretched-link" itemprop="url">
													<span itemprop="item" itemscope itemtype="http://schema.org/MusicRecording">
														<span itemprop="name"><?php the_title(); ?></span>
													</span>
												</a>
												<?php
												lyrico_get_artists(
													array(
														'wrap_before' => '<span class="secondary-media-title">',
														'wrap_after'  => '</span>',
													)
												);
												?>
											</li>
											<?php
											$position++;
										endwhile;

										wp_reset_postdata();
										?>
									</ul>
								</div><!-- itemprop="track" -->
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->

						<?php get_template_part( 'template-parts/single/related-posts' ); ?>
					</div><!-- #primary-div -->

					<?php if ( get_theme_mod( 'single_album_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
					<div id="secondary-div" class="col-md-4">
						<?php get_template_part( 'template-parts/single/album-info' ); ?>

						<?php get_sidebar(); ?>
					</div><!-- #secondary-div -->
					<?php endif; // Check if sidebar is active. ?>
				</div><!-- .row -->
			</div><!-- .main-container -->
		</div><!-- itemtype="http://schema.org/MusicAlbum" -->
	</article>

	<?php
endwhile;

get_footer();
