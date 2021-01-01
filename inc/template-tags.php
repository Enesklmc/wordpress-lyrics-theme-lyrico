<?php
/**
 * Custom template tags for this theme
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( ! function_exists( 'lyrico_edit_link' ) ) :
	/**
	 * Prints edit link.
	 */
	function lyrico_edit_link() {

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit %1$s<span class="screen-reader-text">%1$s</span>', 'lyrico' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'<i class="fas fa-user-edit ml-2"></i></span>'
		);
	}

endif;

if ( ! function_exists( 'lyrico_is_comment_by_post_author' ) ) :
	/**
	 * Returns true if comment is by author of the post
	 *
	 * @param object $comment get Comment.
	 * @return boolean
	 */
	function lyrico_is_comment_by_post_author( $comment = null ) {
		if ( is_object( $comment ) && $comment->user_id > 0 ) {
			$user = get_userdata( $comment->user_id );
			$post = get_post( $comment->comment_post_ID );

			if ( ! empty( $user ) && ! empty( $post ) ) {
				return $comment->user_id === $post->post_author;
			}
		}
		return false;
	}
endif;

if ( ! function_exists( 'lyrico_posted_meta' ) ) :
	/**
	 * Displays post date, author and categories.
	 */
	function lyrico_posted_meta() {
		lyrico_posted_on();
		lyrico_posted_by();

		$categories_list = get_the_category_list( esc_html__( ', ', 'lyrico' ) );
		if ( $categories_list ) {
			printf(
				/* translators: 1: Posted in text. 2: posted in label, only visible to screen readers. 3: list of categories. */
				'<span class="cat-links d-block">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
				'Posted in: ',
				esc_html__( 'Posted in', 'lyrico' ),
				$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
	}
endif;

if ( ! function_exists( 'lyrico_posted_tags' ) ) :
	/**
	 * Displays post tags.
	 */
	function lyrico_posted_tags() {
				/* translators: used between list items, there is a space after the comma. */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'lyrico' ) );
		if ( $tags_list ) {
			printf(
				/* translators: 1: dashicon. 2: posted in label, only visible to screen readers. 3: list of tags. */
				'<span class="tags-links d-block mt-3">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
				'<span class="dashicons dashicons-tag"></span> ',
				esc_html__( 'Tags:', 'lyrico' ),
				$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
	}
endif;

if ( ! function_exists( 'lyrico_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function lyrico_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		printf(
			'<span class="posted-on"><i class="far fa-clock mr-1"></i>%1$s</span>',
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
endif;

if ( ! function_exists( 'lyrico_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function lyrico_posted_by() {
		printf(
			/* translators: 1: admin icon. 2: post author, only visible to screen readers. 3: author link. */
			'<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			'<i class="far fa-user mr-1"></i>',
			esc_html__( 'Posted by', 'lyrico' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'lyrico_show_genres' ) ) :
	/**
	 * Prints HTML with custom taxonomy genres.
	 */
	function lyrico_show_genres() {

		$genres = wp_get_object_terms( get_the_ID(), 'lyrico_genres' );

		$out = array();

		if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
			foreach ( $genres as $genre ) {
				printf(
					'<span class="lyrico-genre-link" itemprop="genre"><a class="btn btn-%3$s" href="%1$s">%2$s</a></span>',
					esc_url( get_term_link( $genre->slug, 'lyrico_genres' ) ),
					esc_html( $genre->name ),
					esc_attr( get_theme_mod( 'button_color_template', 'outline-dark' ) )
				);
			}
		}
	}
endif;

if ( ! function_exists( 'lyrico_get_artists' ) ) :
	/**
	 * Displays artists for album/lyrics
	 *
	 * @param array  $args {
	 *     Optional. An array of Artists arguments.
	 *
	 *     @type string $wrap_before   Text before the Artists markup. Default empty.
	 *     @type string $wrap_after    Text after the Artists markup. Default empty.
	 *     @type string $before_artist Text before each of the artists string. Default empty.
	 *     @type string $after_artist  Text after each of the artists string. Default empty.
	 *     @type bool $link_for_each   Add link for each of the artists. Default false.
	 *     @type bool $echo            If false don't print it. Default true.
	 * }
	 * @param object $post get the post id.
	 * @return string Artists output if artists are defined for the album/lyrics.
	 */
	function lyrico_get_artists( $args = array(), $post = 0 ) {
		$defaults = array(
			'wrap_before'   => '',
			'wrap_after'    => '',
			'before_artist' => '',
			'after_artist'  => '',
			'link_for_each' => false,
			'echo'          => true,
		);

		$args = wp_parse_args( $args, $defaults );

		$post = get_post( $post );

		$id = isset( $post->ID ) ? $post->ID : 0;

		$args = (object) $args;

		$primary_artist_id = get_post_meta( $id, 'lyrico_artist', true );

		if ( empty( $primary_artist_id ) ) {
			return;
		}

		$artists = '';
		if ( true === $args->link_for_each ) {
			$primary_artist = sprintf(
				'<a href="%s" class="primary-artist">%s</a>',
				esc_url( get_the_permalink( $primary_artist_id ) ),
				$args->before_artist . esc_html( get_the_title( $primary_artist_id ) ) . $args->after_artist
			);
			$artists       .= $primary_artist;
		} else {
			$primary_artist = esc_html( get_the_title( $primary_artist_id ) );
			$artists       .= $args->before_artist . $primary_artist . $args->after_artist;
		}

		$other_artists = get_post_meta( $id, 'lyrico_other_artists', true );

		if ( ! empty( $other_artists ) ) :
			$artists .= ' &#183; ';
			if ( is_array( $other_artists ) || is_object( $other_artists ) ) {
				if ( true === $args->link_for_each ) {
					foreach ( $other_artists as $other_artist_id ) {
						$other_artist = sprintf(
							'<a href="%s" class="other-artist">%s</a>',
							esc_url( get_the_permalink( $other_artist_id ) ),
							$args->before_artist . esc_html( get_the_title( $other_artist_id ) ) . $args->after_artist
						);

						$artists .= $other_artist;

						if ( next( $other_artists ) ) {
							$artists .= ', ';
						}
					}
				} else {
					foreach ( $other_artists as $other_artist_id ) {
						$other_artist = esc_html( get_the_title( $other_artist_id ) );

						$artists .= $args->before_artist . $other_artist . $args->after_artist;

						if ( next( $other_artists ) ) {
							$artists .= ', ';
						}
					}
				}
			}
		endif;
		$output = $args->wrap_before . $artists . $args->wrap_after;
		if ( true === $args->echo ) {
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'lyrico_implode_and_support_schema' ) ) :
	/**
	 * Implode elements and wrap each item with Html markup.
	 *
	 * @param array  $post_meta_array Receive input to be implode and wrap.
	 * @param string $before          Text before for each of the array element. Default empty.
	 * @param string $after           Text after for each of the array element. Default empty.
	 */
	function lyrico_implode_and_support_schema( $post_meta_array = array(), $before = '', $after = '' ) {
		$output = '';
		foreach ( (array) $post_meta_array as $post_meta ) {
			$post_meta = sprintf(
				'%s%s%s',
				$before,
				esc_html( $post_meta ),
				$after
			);
			$output   .= $post_meta;
			if ( is_array( $post_meta_array ) && next( $post_meta_array ) ) {
				$output .= ', ';
			}
		}
		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'lyrico_iso_length_format' ) ) :
	/**
	 * Convert custom meta box length(e.g. 4:53) to iso format (PT4M53S).
	 *
	 * @param string $content Get input to be convert.
	 * @return string length with iso format.
	 */
	function lyrico_iso_length_format( $content ) {
		$content = str_replace( ':', 'M', $content );
		$content = preg_replace( '/\s+/', '', $content );
		$output  = 'PT' . $content . 'S';
		return $output;
	}
endif;

if ( ! function_exists( 'convert_youtube_embed' ) ) :
	/**
	 * Displays Youtube embed url that converted from youtube video url
	 *
	 * @param object $url Get video url.
	 * @return string Youtube embed url.
	 */
	function convert_youtube_embed( $url ) {
		return preg_replace(
			'/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i',
			'www.youtube.com/embed/$2',
			$url
		);
	}
endif;

if ( ! function_exists( 'create_spotify_embed' ) ) :
	/**
	 * Displays Spotify embed url that converted from spotify song url
	 *
	 * @param object $url Get song url.
	 * @return string Spotify embed url.
	 */
	function create_spotify_embed( $url = '' ) {
		$url = trim( strtok( $url, '?' ) );
		$url = str_replace( 'track', 'embed/track', $url );
		return $url;
	}
endif;

if ( ! function_exists( 'lyrico_pagination' ) ) :
	/**
	 * Retrieve paginated link for archive post pages.
	 *
	 * @param array $args {
	 *     Optional. String of arguments for generating paginated links for archives.
	 *
	 *     @type string $wrap_before Text before the paginated links. Default empty.
	 *     @type string $wrap_after  Text after the paginated links. Default empty.
	 *     @type string $total       The total amount of pages. Default is the value WP_Query's
	 *                               `max_num_pages` or 1.
	 * }
	 * @return string String of page links.
	 */
	function lyrico_pagination( $args = array() ) {
		$defaults = array(
			'wrap_before' => '',
			'wrap_after'  => '',
			'total'       => '',
		);

		$args = wp_parse_args( $args, $defaults );

		$args = (object) $args;

		if ( ! empty( $args->total ) ) {
			if ( $args->total < 2 ) {
				return;
			}
			printf(
				'%2$s<nav class="pagination-navbar my-4">%1$s</nav>%3$s',
				paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					array(
						'total'     => $args->total,
						'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
						'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>',
					)
				),
				$args->wrap_before, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$args->wrap_after // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		} else {
			global $wp_query;
			if ( $wp_query->found_posts <= get_option( 'posts_per_page' ) ) {
				return;
			}
			printf(
				'%2$s<nav class="pagination-navbar my-4">%1$s</nav>%3$s',
				paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					array(
						'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
						'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>',
					)
				),
				$args->wrap_before, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$args->wrap_after // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}

	}

endif;

if ( ! function_exists( 'lyrico_show_social_media_icons' ) ) :
	/**
	 * Get user input from the Customizer and output the linked social media icons.
	 */
	function lyrico_show_social_media_icons( $args = array() ) {
		$defaults = array(
			'wrap_with_ul' => false,
			'ul_class'     => '',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = (object) $args;

		if ( get_theme_mod( 'show_social_media_icons_on_top', 1 ) === 1 ) {

			if ( get_theme_mod( 'show_social_with_brand_colors' ) === 1 ) {
				$is_active_brand_color = ' with-brand-colors';
			} else {
				$is_active_brand_color = '';
			}

			$social_sites = lyrico_get_social_media_sites();

			foreach ( $social_sites as $social_site ) {
				if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
					$active_sites[] = $social_site;
				}
			}

			if ( ! empty( $active_sites ) ) {
				if ( true === $args->wrap_with_ul ) {
					printf(
						'<ul class="%1$s%2$s">',
						esc_html( $args->ul_class ),
						esc_attr( $is_active_brand_color )
					);
				}
				foreach ( $active_sites as $active_site ) {
					if ( 'rss' === $active_site ) {
						?>
						<li class="nav-item brand-icon-item">
							<a href="<?php echo esc_url( get_theme_mod( $active_site ) ); ?>" target="_blank" rel="nofollow">
								<i class="brand-icon fas fa-<?php echo esc_html( $active_site ); ?>"></i>
							</a>
						</li>
						<?php
					} elseif ( 'email' === $active_site ) {
						?>
						<li class="nav-item brand-icon-item">
							<a href="<?php echo esc_url( get_theme_mod( $active_site ) ); ?>" target="_blank" rel="nofollow">
								<i class="brand-icon fas fa-envelope"></i>
							</a>
						</li>
						<?php
					} elseif ( 'facebook' === $active_site ) {
						?>
						<li class="nav-item brand-icon-item">
							<a href="<?php echo esc_url( get_theme_mod( $active_site ) ); ?>" target="_blank" rel="nofollow">
								<i class="brand-icon fab fa-facebook-f"></i>
							</a>
						</li>
						<?php
					} else {
						?>
						<li class="nav-item brand-icon-item">
							<a href="<?php echo esc_url( get_theme_mod( $active_site ) ); ?>" target="_blank" rel="nofollow">
								<i class="brand-icon fab fa-<?php echo esc_html( $active_site ); ?>"></i>
							</a>
						</li>
						<?php
					}
				}
				if ( true === $args->wrap_with_ul ) {
					echo '</ul>';
				}
			}
		}
	}
endif;
