<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();
?>

<?php get_template_part( 'template-parts/header/page', 'header' ); ?>

<div class="container main-container">
	<div class="row">
		<div id="primary-div" class="col-md-8">
			<div class="lyrico-module-wrapper">
				<div class="lyrico-module">
					<?php
					if ( have_posts() ) :
						echo '<ul class="list-group list-group-flush">';

						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/components/list-item', 'with-badges' );
						endwhile;

						echo '</ul>';

						lyrico_pagination();
					endif;
					?>
				</div><!-- .lyrico-module -->
			</div><!-- .lyrico-module-wrapper -->
		</div><!-- #primary-div -->

		<?php if ( get_theme_mod( 'archive_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
		<div id="secondary-div" class="col-md-4">
			<?php get_sidebar(); ?>
		</div><!-- #secondary-div -->
		<?php endif; ?>
	</div><!-- .row -->
</div><!-- .main-container -->

<?php
get_footer();
