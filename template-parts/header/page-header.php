<?php
/**
 * Displays the page header
 * Artists Page, Albums Page, Playlists Page, Default Page, Genres Page, Archive Page
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>

<div data-template="<?php echo 'lyrico-gradient-' . esc_attr( get_theme_mod( 'header_background_template', 'midnight-city' ) ); ?>" class="lyrico-site-header container-fluid page-header-container <?php echo 'lyrico-gradient-' . esc_attr( get_theme_mod( 'header_background_template', 'midnight-city' ) ); ?>">
	<div class="position-relative py-3 py-sm-4 py-lg-5">
		<header class="py-5 px-4 px-md-5 d-flex">
			<?php
			if ( is_archive() ) {
				the_archive_title( '<h1 class="my-0 mx-auto">', '</h1>' );
			} else {
				echo '<h1 class="my-0 mx-auto">';
				single_post_title();
				if ( is_page() ) {
					lyrico_edit_link();
				}
				echo '</h1>';
			}
			?>
		</header>
	</div>
</div>
