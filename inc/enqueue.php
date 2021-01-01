<?php
/**
 * Enqueue Scripts & Styles
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( ! function_exists( 'lyrico_fonts_url' ) ) :
	/**
	 * Register Google fonts.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function lyrico_fonts_url() {
		$fonts_url = '';
		$fonts     = array();

		// Body Fonts JSON.
		$json      = get_theme_mod( 'google_fonts_body' );
		$font_body = json_decode( $json );

		$weights_body = array();

		// Add Weights into weights_body() array.
		if ( ! empty( $font_body->regularweight ) ) {
			$weights_body[] = $font_body->regularweight;
		}
		if ( ! empty( $font_body->thinweight ) ) {
			$weights_body[] = $font_body->thinweight;
		}
		if ( ! empty( $font_body->boldweight ) ) {
			$weights_body[] = $font_body->boldweight;
		}

		// Remove duplicate values from an array.
		$weights_body = array_unique( $weights_body );

		$weights_body = implode( ',', $weights_body );

		$fonts[] = $font_body->font . ':' . $weights_body;

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => rawurlencode( implode( '|', $fonts ) ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Enqueue Scripts & Styles
 */
function lyrico_scripts() {

	if ( get_theme_mod( 'google_font_activation', 0 ) === 1 ) :
		wp_enqueue_style( 'google-font', lyrico_fonts_url(), array(), wp_get_theme()->get( 'Version' ) );
	endif;

	wp_enqueue_style( 'bootstrap', get_theme_file_uri( 'assets/css/bootstrap.min.css' ), array(), '4.3.1' );
	wp_style_add_data( 'bootstrap', 'rtl', 'replace' );

	wp_enqueue_style( 'font-awesome-css', get_theme_file_uri( 'assets/css/fontawesome-all.min.css' ), array(), '5.11.2' );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'lyrico-print-style', get_theme_file_uri( 'print.css' ), array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Theme stylesheet.
	wp_enqueue_style( 'lyrico-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	wp_style_add_data( 'lyrico-style', 'rtl', 'replace' );

	wp_enqueue_style( 'swiper-css', get_theme_file_uri( 'assets/css/swiper.min.css' ), array(), '5.0.4' );

	// Scripts.
	wp_enqueue_script( 'popper', get_theme_file_uri( 'assets/js/popper.min.js' ), array( 'jquery' ), '4.3.1', true );

	wp_enqueue_script( 'bootstrap', get_theme_file_uri( 'assets/js/bootstrap.min.js' ), array( 'jquery' ), '4.3.1', true );
	wp_script_add_data( 'bootstrap', 'rtl', 'replace' );

	wp_enqueue_script( 'lyrico-script', get_theme_file_uri( 'assets/js/lyrico.js' ), array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

	wp_enqueue_script( 'swiper', get_theme_file_uri( 'assets/js/swiper.min.js' ), array( 'jquery' ), '5.0.4', true );

	wp_enqueue_script( 'jquery-ui-tabs' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lyrico_scripts' );

/**
 * Enqueue Admin Scripts & Styles
 *
 * @param string $hook get current admin page.
 */
function lyrico_custom_wp_admin_script( $hook ) {
	if ( 'post-new.php' !== $hook && 'post.php' !== $hook ) {
		return;
	}

	wp_enqueue_style( 'select2_css', get_theme_file_uri( 'assets/css/select2.min.css' ), array(), '4.0.11', 'all' );

	wp_enqueue_style( 'admin_css', get_theme_file_uri( 'assets/css/admin.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );

	wp_enqueue_media();

	wp_enqueue_script( 'select2_js', get_theme_file_uri( 'assets/js/select2.min.js' ), array( 'jquery' ), '4.0.11', true );

	wp_enqueue_script( 'admin_js', get_theme_file_uri( 'assets/js/admin.js' ), array( 'jquery', 'select2_js' ), wp_get_theme()->get( 'Version' ), true );

	wp_enqueue_script( 'jquery-ui-tabs' );
}
add_action( 'admin_enqueue_scripts', 'lyrico_custom_wp_admin_script' );
