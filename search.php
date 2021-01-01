<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="main-container container">
			<div class="row">
				<div id="primary-div" class="col-md-8">
					<div class="lyrico-module-wrapper">
						<div class="lyrico-module">
							<div class="module-header">
								<h1 class="h2">
									<?php
									printf(
										/* translators: %s: searched work  */
										esc_html__( 'Searching For: &#x22;%s&#x22;', 'lyrico' ),
										get_search_query()
									);
									?>
								</h1>
							</div><!-- module-header -->
							<div class="searching-page-form p-4 p-lg-5 border rounded">
								<?php get_search_form(); ?>
							</div><!-- .searching-page-form -->
						</div><!-- .lyrico-module -->
					</div><!-- .lyrico-module-wrapper -->

					<?php if ( have_posts() ) : ?>
					<div class="lyrico-module-wrapper">
						<div class="lyrico-module">
							<ul class="searching-results list-group">
								<?php
								while ( have_posts() ) :
									the_post();

									get_template_part( 'template-parts/components/list-item', 'with-badges' );
								endwhile;
								?>
							</ul>

							<?php lyrico_pagination(); ?>
						</div><!-- .lyrico-module -->
					</div><!-- .lyrico-module-wrapper -->
					<?php else : ?>

						<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

					<?php endif; ?>
				</div><!-- #primary-div -->

				<?php if ( get_theme_mod( 'archive_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
				<div id="secondary-div" class="col-md-4">
					<?php get_sidebar(); ?>
				</div><!-- #secondary-div -->
				<?php endif; ?>
			</div><!-- .row -->
		</div><!-- .main-container -->
	</article>

<?php
get_footer();
