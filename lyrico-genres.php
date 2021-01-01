<?php
/**
 * Template Name: Genres
 *
 * The template for display all Genres
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();

$terms = get_terms(
	array(
		'taxonomy'   => 'lyrico_genres',
		'hide_empty' => false,
	)
);

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
										<div class="content-genres entry-content">
											<?php the_content(); ?>
										</div><!-- .entry-content -->
									</div>
								</div>
								<?php
							endif;
						endwhile;
					endif;
					?>

					<div class="lyrico-module-wrapper">
						<div class="lyrico-module">
							<div class="genres-content row m-0">
								<?php
								$output = '';
								foreach ( $terms as $the_term ) :
									$genre_link = get_category_link( $the_term->term_id );
									?>
									<div class="col-6 col-sm-4 col-lg-3 genre-card-wrapper">
										<div class="genre-card">
										<?php
										printf(
											// translators: 1: Genre URL, 2: Genre name.
											'<a class="genre-card-title full-width-link" href="%1$s"><span class="m-auto">%2$s</span></a>',
											esc_url( $genre_link ),
											esc_html( $the_term->name )
										);
										?>
										</div>
									</div>
									<?php
								endforeach;
								?>
							</div><!-- .genres-content -->
						</div><!-- .lyrico-module -->
					</div><!-- .lyrico-module-wrapper -->
				</div> <!-- #primary-div -->

				<?php if ( get_theme_mod( 'page_genres_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
				<div id="secondary-div" class="col-md-4">
					<?php get_sidebar(); ?>
				</div> <!-- #secondary-div -->
				<?php endif; ?>
			</div><!-- .row -->
		</div><!-- .main-container -->
	</article><!-- #post-<?php the_ID(); ?> -->

<?php
get_footer();
