<?php
/**
 * Ajax Functions
 *
 * @package Lyrico
 * @since 1.0.0
 */

/**
 * Get Artists.
 */
function lyrico_get_artists_ajax_callback() {

	$return = array();

	$query_artists = new WP_Query(
		array(
			'post_type'           => 'lyrico_artist',
			's'                   => filter_input( INPUT_GET, 'q', FILTER_SANITIZE_STRING ),
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => 10,
		)
	);

	if ( $query_artists->have_posts() ) :
		while ( $query_artists->have_posts() ) :
			$query_artists->the_post();
			$title    = ( mb_strlen( $query_artists->post->post_title ) > 50 ) ? mb_substr( $query_artists->post->post_title, 0, 49 ) . '...' : $query_artists->post->post_title;
			$return[] = array( $query_artists->post->ID, $title );
		endwhile;
	endif;

	echo wp_json_encode( $return );
	die;
}
add_action( 'wp_ajax_lyricogetartists', 'lyrico_get_artists_ajax_callback' );
