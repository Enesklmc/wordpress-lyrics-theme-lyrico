<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://developer.wordpress.org/themes/functionality/404-pages/
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();
?>

<div class="container main-container">
	<div class="row">
		<div id="primary-div" class="col-md-8 d-flex">
			<div class="lyrico-module-wrapper">
				<div class="lyrico-module p-4 p-md-5">
					<div class="error-404 not-found mb-auto m-md-auto">
						<div class="text-404 display-3"><?php esc_html_e( '404', 'lyrico' ); ?></div>

						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'lyrico' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p class="mb-3"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'lyrico' ); ?></p>

							<?php get_search_form(); ?>
						</div><!-- .page-content -->
					</div><!-- .error-404 -->
				</div><!-- .lyrico-module -->
			</div><!-- .lyrico-module-wrapper -->
		</div><!-- #primary-div -->

		<?php if ( get_theme_mod( 'not_found_content_layout', 'no-sidebar' ) !== 'no-sidebar' ) : ?>
		<div id="secondary-div" class="col-md-4">
			<?php get_sidebar(); ?>
		</div><!-- #secondary-div -->
		<?php endif; ?>
	</div><!-- .row -->
</div><!-- .main-container -->

<?php
get_footer();
