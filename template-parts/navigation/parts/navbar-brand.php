<?php
/**
 * Brand for Navbar templates
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>
<a class="navbar-brand" href="<?php echo esc_html( get_home_url() ); ?>">
	<?php
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo           = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	if ( has_custom_logo() ) {
		echo '<img src="' . esc_url( $logo[0] ) . '" class="d-inline-block mr-1 brand-img" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
	}

	echo '<span class="brand-text">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
	?>
</a>
