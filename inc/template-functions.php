<?php
/**
 * Functions which enhance the theme
 *
 * @package Lyrico
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function lyrico_body_classes( $classes ) {

	if ( get_theme_mod( 'modular_design', 1 ) === 1 ) {
		$classes[] = 'modular-design';
	}

	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	if ( get_theme_mod( 'full_width_content', 0 ) === 1 ) {
		$classes[] = 'full-width-content';
	}

	if ( get_theme_mod( 'top_navbar_fixed', 0 ) === 1 ) {
		$classes[] = 'fixed-navbar-top';
	}

	if ( get_theme_mod( 'go_top_button', 0 ) === 1 ) {
		$classes[] = 'go-top-button';
	}

	if ( get_theme_mod( 'google_font_activation', 0 ) === 1 ) {
		$classes[] = 'google-fonts';
	}

	if ( ! is_front_page() && is_home() ) {
		$classes[] = get_theme_mod( 'latest_posts_content_layout', 'sidebar-right' );
	}

	if ( is_404() ) {
		$classes[] = get_theme_mod( 'not_found_content_layout', 'no-sidebar' );
	}

	if ( is_archive() ) {
		$classes[] = get_theme_mod( 'archive_content_layout', 'sidebar-right' );
	}

	if ( is_page() && ! is_front_page() && ! is_page_template() ) {
		$classes[] = get_theme_mod( 'page_content_layout', 'sidebar-right' );
	}

	if ( is_page_template( 'page-artists.php' ) ) {
		$classes[] = get_theme_mod( 'page_artists_content_layout', 'no-sidebar' );
	}

	if ( is_page_template( 'page-albums.php' ) ) {
		$classes[] = get_theme_mod( 'page_albums_content_layout', 'no-sidebar' );
	}

	if ( is_page_template( 'page-playlists.php' ) ) {
		$classes[] = get_theme_mod( 'page_playlists_content_layout', 'no-sidebar' );
	}

	if ( is_page_template( 'lyrico-genres.php' ) ) {
		$classes[] = get_theme_mod( 'page_genres_content_layout', 'sidebar-right' );
	}

	if ( is_page_template( 'lyrico-home.php' ) ) {
		$classes[] = get_theme_mod( 'home_content_layout', 'sidebar-right' );
	}

	if ( is_singular( 'post' ) ) {
		$classes[] = get_theme_mod( 'blog_content_layout', 'sidebar-right' );
	}

	if ( is_singular( 'lyrico_lyrics' ) ) {
		$classes[] = get_theme_mod( 'single_lyrics_content_layout', 'sidebar-right' );
	}

	if ( is_singular( 'lyrico_album' ) ) {
		$classes[] = get_theme_mod( 'single_album_content_layout', 'sidebar-right' );
	}

	if ( is_singular( 'lyrico_artist' ) ) {
		$classes[] = get_theme_mod( 'single_artist_content_layout', 'sidebar-right' );
	}

	if ( is_singular( 'lyrico_playlist' ) ) {
		$classes[] = get_theme_mod( 'single_playlist_content_layout', 'sidebar-right' );
	}

	return $classes;
}
add_filter( 'body_class', 'lyrico_body_classes' );

/**
 * Adds custom class to the array of posts classes.
 */
function lyrico_post_classes( $classes, $class, $post_id ) {
	$classes[] = 'entry';

	return $classes;
}
add_filter( 'post_class', 'lyrico_post_classes', 10, 3 );

/**
 * Display footer brand.
 */
function lyrico_show_footer_brand() {
	if ( get_theme_mod( 'hide_footer_brand', 0 ) === 0 ) {
		echo '<div id="footer-brand-wrapper" class="text-center my-4">';
			get_template_part( 'template-parts/navigation/parts/navbar-brand' );
		echo '</div>';
	}
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function lyrico_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'lyrico_pingback_header' );

/**
 * AJAX Load More
 */
function lyrico_load_more() {
	$paged = ( filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT ) || ! ( empty( filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT ) ) ) ) ? filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT ) + 1 : 1;
	$query = new WP_Query(
		array(
			'post_type'      => 'lyrico_playlist',
			'paged'          => $paged,
			'post_status'    => 'publish',
			'posts_per_page' => get_theme_mod( 'page_playlists_all_playlists_number', 24 ),
		)
	);

	if ( get_theme_mod( 'page_playlists_content_layout', 'no-sidebar' ) !== 'no-sidebar' ) :
		$card_column = 'col-6 col-sm-4 col-lg-3';
	else :
		$card_column = 'col-6 col-sm-4 col-md-3 col-lg-2';
	endif;

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post(); ?>
			<div class="<?php echo esc_attr( $card_column ); ?> post-component-wrapper">
				<?php get_template_part( 'template-parts/components/card', get_theme_mod( 'page_playlists_all_playlists_style', 'image-overlay' ) ); ?>
			</div>
		<?php endwhile; ?>
		<?php
	endif;

	wp_reset_postdata();
	die();
}

add_action( 'wp_ajax_nopriv_lyrico_load_more', 'lyrico_load_more' );
add_action( 'wp_ajax_lyrico_load_more', 'lyrico_load_more' );

/**
 * Social Media icon helper functions
 */
function lyrico_get_social_media_sites() {

		// Store social site names in array.
		$social_sites = array(
			'spotify',
			'soundcloud',
			'twitter',
			'facebook',
			'flickr',
			'pinterest',
			'youtube',
			'vimeo',
			'tumblr',
			'dribbble',
			'rss',
			'linkedin',
			'instagram',
			'email',
		);
		return $social_sites;
}

/**
 * Generate custom search form for avoiding several same input in same page.
 * Otherwise radio buttons does not work.
 */
function lyrico_search_form( $form ) {
	static $form_id = 0;
	$form_id++;

	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<div class="input-group input-group-lg">
		<label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'lyrico' ) . '</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="search-form-input-small" class="form-control pl-1"/>
		<input type="submit" id="search-form-button" class="btn btn-sm btn-outline-secondary input-group-append" value="' . esc_attr__( 'Search', 'lyrico' ) . '" />
	</div>
	<div class="mt-2 search-form-radio-buttons">
	<div class="custom-control custom-radio custom-control-inline mr-2">
		<input class="custom-control-input" type="radio" name="post_type" value="all" id="allRadio' . $form_id . '" checked="checked">
		<label class="custom-control-label" for="allRadio' . $form_id . '">All</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline mr-2">
		<input class="custom-control-input" type="radio" name="post_type" id="lyricsRadio' . $form_id . '" value="lyrico_lyrics">
		<label class="custom-control-label" for="lyricsRadio' . $form_id . '">Lyrics</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline mr-2">
		<input class="custom-control-input" type="radio" name="post_type" id="artistRadio' . $form_id . '" value="lyrico_artist">
		<label class="custom-control-label" for="artistRadio' . $form_id . '">Artist</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline mr-2">
		<input class="custom-control-input" type="radio" name="post_type" id="albumRadio' . $form_id . '" value="lyrico_album">
		<label class="custom-control-label" for="albumRadio' . $form_id . '">Album</label>
	</div>
	</div>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'lyrico_search_form' );

/**
 * Add +1 page view each time the page is visited.
 *
 * @param object $post_id get the id.
 */
function lyrico_save_post_views( $post_id ) {

	$meta_key = 'lyrico_post_views';
	$views    = get_post_meta( $post_id, $meta_key, true );
	$count    = ( empty( $views ) ? '1' : $views );
	$count++;
	update_post_meta( $post_id, $meta_key, $count );
}
