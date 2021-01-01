<?php
/**
 * The header for Lyrico
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site position-relative">
	<header id="site-navigation">
		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div id="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/' . get_theme_mod( 'navbar_layout', 'navbar-1' ) ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>

		<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="searchModalLabel"><?php esc_html_e( 'Search', 'lyrico' ); ?></h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div><!-- .modal-header -->

					<div class="modal-body">
						<?php get_search_form(); ?>
					</div><!-- .modal-body -->
				</div><!-- .modal-content -->
			</div><!-- .modal-dialog -->
		</div><!-- .modal -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
