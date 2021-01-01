<?php
/**
 * Lyrico: Customizer
 *
 * @package Lyrico
 */

/**
 * Lyrico: Customizer
 *
 * @param object $wp_customize WordPress customize object.
 */
function lyrico_customize_register( $wp_customize ) {

	// Inlcude the Custom controls file.
	require_once dirname( __FILE__ ) . '/customizer-custom-controls.php';

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	/*
	-------------------------------------------*
	*------- Selective Refresh -------*
	*--------------------------------------------*
	*/
	// Footer.
	$wp_customize->selective_refresh->add_partial(
		'hide_footer_brand',
		array(
			'selector'        => '#footer-brand-wrapper',
			'render_callback' => 'lyrico_show_footer_brand',
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Homepage Setup -------*
	*--------------------------------------------*
	*/

	$wp_customize->add_section(
		'homepage_settings',
		array(
			'title'           => esc_html__( 'Homepage Setup', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_lyrico_home',
		)
	);

	$wp_customize->add_setting(
		'home_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'home_content_layout',
			array(
				'label'   => esc_html__( 'Homepage Layout', 'lyrico' ),
				'section' => 'homepage_settings',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	/**
	 * Home Search Section
	 */
	$wp_customize->add_setting(
		'home_search_section',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Header_In_Section(
			$wp_customize,
			'home_search_section',
			array(
				'label'   => esc_html__( 'Search Section', 'lyrico' ),
				'section' => 'homepage_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'hide_home_search_section',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_home_search_section',
		array(
			'label'   => esc_html__( 'Hide this section', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'checkbox',
		)
	);

	/**
	 * Home Latest Lyrics Section
	 */
	$wp_customize->add_setting(
		'home_latest_lyrics_section',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Header_In_Section(
			$wp_customize,
			'home_latest_lyrics_section',
			array(
				'label'   => esc_html__( 'Latest Lyrics Section', 'lyrico' ),
				'section' => 'homepage_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'hide_home_latest_lyrics_section',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_home_latest_lyrics_section',
		array(
			'label'   => esc_html__( 'Hide this section', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_latest_lyrics_title',
		array(
			'default'           => esc_html__( 'Latest Lyrics', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_latest_lyrics_title',
		array(
			'label'       => esc_html__( 'Module Title:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter title...', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_latest_lyrics_number',
		array(
			'default'           => 8,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_latest_lyrics_number',
		array(
			'label'   => esc_html__( 'Number of posts: ', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'number',
		)
	);

	/**
	 * Home Playlists Section
	 */
	$wp_customize->add_setting(
		'home_playlists_section',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Header_In_Section(
			$wp_customize,
			'home_playlists_section',
			array(
				'label'   => esc_html__( 'Playlists Section', 'lyrico' ),
				'section' => 'homepage_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'hide_home_playlists_section',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_home_playlists_section',
		array(
			'label'   => esc_html__( 'Hide this section', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_playlists_title',
		array(
			'default'           => esc_html__( 'Featured Playlists', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_playlists_title',
		array(
			'label'       => esc_html__( 'Module Title:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter title...', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_playlists_number',
		array(
			'default'           => 12,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_playlists_number',
		array(
			'label'   => esc_html__( 'Number of posts: ', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'number',
		)
	);

	$wp_customize->add_setting(
		'home_playlists_page',
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_playlists_page',
		array(
			'label'   => esc_html__( 'Select Playlists Page', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'dropdown-pages',
		)
	);

	$wp_customize->add_setting(
		'home_playlists_sorting',
		array(
			'default'           => 'date',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'home_playlists_sorting',
		array(
			'label'   => esc_html__( 'Sort Playlists By:', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'radio',
			'choices' => array(
				'date'       => esc_html__( 'Date', 'lyrico' ),
				'popularity' => esc_html__( 'Popularity', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_playlists_button_text',
		array(
			'default'           => esc_html__( 'See all Playlists', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_playlists_button_text',
		array(
			'label'       => esc_html__( 'Button Text:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter button text...', 'lyrico' ),
			),
		)
	);

	/**
	 * Home Artists Section
	 */
	$wp_customize->add_setting(
		'home_artists_section',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Header_In_Section(
			$wp_customize,
			'home_artists_section',
			array(
				'label'   => esc_html__( 'Artists Section', 'lyrico' ),
				'section' => 'homepage_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'hide_home_artists_section',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_home_artists_section',
		array(
			'label'   => esc_html__( 'Hide this section', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_artists_title',
		array(
			'default'           => esc_html__( 'Featured Artists', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_artists_title',
		array(
			'label'       => esc_html__( 'Module Title:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter title...', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_artists_number',
		array(
			'default'           => 12,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_artists_number',
		array(
			'label'   => esc_html__( 'Number of posts: ', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'number',
		)
	);

	$wp_customize->add_setting(
		'home_artists_page',
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_artists_page',
		array(
			'label'   => esc_html__( 'Select Artists Page', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'dropdown-pages',
		)
	);

	$wp_customize->add_setting(
		'home_artists_sorting',
		array(
			'default'           => 'date',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'home_artists_sorting',
		array(
			'label'   => esc_html__( 'Sort Artists By:', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'radio',
			'choices' => array(
				'date'       => esc_html__( 'Date', 'lyrico' ),
				'popularity' => esc_html__( 'Popularity', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_artists_button_text',
		array(
			'default'           => esc_html__( 'See all Artists', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_artists_button_text',
		array(
			'label'       => esc_html__( 'Button Text:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter button text...', 'lyrico' ),
			),
		)
	);

	/**
	 * Home Albums Section
	 */
	$wp_customize->add_setting(
		'home_albums_section',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Header_In_Section(
			$wp_customize,
			'home_albums_section',
			array(
				'label'   => esc_html__( 'Albums Section', 'lyrico' ),
				'section' => 'homepage_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'hide_home_albums_section',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_home_albums_section',
		array(
			'label'   => esc_html__( 'Hide this section', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_albums_title',
		array(
			'default'           => esc_html__( 'Featured Albums', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_albums_title',
		array(
			'label'       => esc_html__( 'Module Title:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter title...', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_albums_number',
		array(
			'default'           => 12,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_albums_number',
		array(
			'label'   => esc_html__( 'Number of posts: ', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'number',
		)
	);

	$wp_customize->add_setting(
		'home_albums_page',
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_albums_page',
		array(
			'label'   => esc_html__( 'Select Albums Page', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'dropdown-pages',
		)
	);

	$wp_customize->add_setting(
		'home_albums_sorting',
		array(
			'default'           => 'date',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'home_albums_sorting',
		array(
			'label'   => esc_html__( 'Sort Albums By:', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'radio',
			'choices' => array(
				'date'       => esc_html__( 'Date', 'lyrico' ),
				'popularity' => esc_html__( 'Popularity', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_albums_button_text',
		array(
			'default'           => esc_html__( 'See all Albums', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_albums_button_text',
		array(
			'label'       => esc_html__( 'Button Text:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter button text...', 'lyrico' ),
			),
		)
	);

	/**
	 * Home Popular Lyrics Section
	 */
	$wp_customize->add_setting(
		'home_popular_lyrics_section',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Header_In_Section(
			$wp_customize,
			'home_popular_lyrics_section',
			array(
				'label'   => esc_html__( 'Popular Lyrics Section', 'lyrico' ),
				'section' => 'homepage_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'hide_home_popular_lyrics_section',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_home_popular_lyrics_section',
		array(
			'label'   => esc_html__( 'Hide this section', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_popular_lyrics_title',
		array(
			'default'           => esc_html__( 'Popular Lyrics', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_popular_lyrics_title',
		array(
			'label'       => esc_html__( 'Module Title:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter title...', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_popular_lyrics_number',
		array(
			'default'           => 10,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_popular_lyrics_number',
		array(
			'label'   => esc_html__( 'Number of posts: ', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'number',
		)
	);

	/**
	 * Home News Section
	 */
	$wp_customize->add_setting(
		'home_news_section',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Header_In_Section(
			$wp_customize,
			'home_news_section',
			array(
				'label'   => esc_html__( 'Latest Posts Section', 'lyrico' ),
				'section' => 'homepage_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'hide_home_news_section',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_home_news_section',
		array(
			'label'   => esc_html__( 'Hide this section', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_news_title',
		array(
			'default'           => esc_html__( 'News', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_news_title',
		array(
			'label'       => esc_html__( 'Module Title:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter title...', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_news_number',
		array(
			'default'           => 5,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_news_number',
		array(
			'label'   => esc_html__( 'Number of posts: ', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'number',
		)
	);

	$wp_customize->add_setting(
		'home_news_page',
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_news_page',
		array(
			'label'   => esc_html__( 'Select Latest Posts Page', 'lyrico' ),
			'section' => 'homepage_settings',
			'type'    => 'dropdown-pages',
		)
	);

	$wp_customize->add_setting(
		'home_news_button_text',
		array(
			'default'           => esc_html__( 'See all News', 'lyrico' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'home_news_button_text',
		array(
			'label'       => esc_html__( 'Button Text:', 'lyrico' ),
			'section'     => 'homepage_settings',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Enter button text...', 'lyrico' ),
			),
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Current Page Layout & Settings -------*
	*--------------------------------------------*
	*/

	/**
	 * Artists Page Settings
	 */
	$wp_customize->add_section(
		'page_artists_settings_section',
		array(
			'title'           => esc_html__( 'Artists Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_artists_page',
		)
	);

	$wp_customize->add_setting(
		'page_artists_content_layout',
		array(
			'default'           => 'no-sidebar',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'page_artists_content_layout',
			array(
				'label'   => esc_html__( 'Artists Page Layout', 'lyrico' ),
				'section' => 'page_artists_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'page_artists_hide_featured_artists',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_artists_hide_featured_artists',
		array(
			'label'   => esc_html__( 'Hide Featured Artists', 'lyrico' ),
			'section' => 'page_artists_settings_section',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'page_artists_featured_artists_number',
		array(
			'default'           => 8,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'page_artists_featured_artists_number',
		array(
			'label'           => esc_html__( 'Featured Artists to show at most:', 'lyrico' ),
			'section'         => 'page_artists_settings_section',
			'type'            => 'number',
			'active_callback' => function() {
					return ! get_theme_mod( 'page_artists_hide_featured_artists', 0 );
			},
		)
	);

	$wp_customize->add_setting(
		'page_artists_featured_artists_style',
		array(
			'default'           => 'image-overlay',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_artists_featured_artists_style',
		array(
			'label'           => esc_html__( 'Featured Artists Style', 'lyrico' ),
			'section'         => 'page_artists_settings_section',
			'type'            => 'radio',
			'active_callback' => function() {
				return ! get_theme_mod( 'page_artists_hide_featured_artists', 0 );
			},
			'choices'         => array(
				'image-overlay' => esc_html__( 'Text Overlay Image', 'lyrico' ),
				'image-text'    => esc_html__( 'Text Under Image', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'page_artists_all_artists_number',
		array(
			'default'           => 24,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'page_artists_all_artists_number',
		array(
			'label'   => esc_html__( 'All Artists to show at most:', 'lyrico' ),
			'section' => 'page_artists_settings_section',
			'type'    => 'number',
		)
	);

	$wp_customize->add_setting(
		'page_artists_all_artists_style',
		array(
			'default'           => 'card-image-overlay',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_artists_all_artists_style',
		array(
			'label'   => esc_html__( 'All Artists Style', 'lyrico' ),
			'section' => 'page_artists_settings_section',
			'type'    => 'radio',
			'choices' => array(
				'card-image-overlay' => esc_html__( 'Text Overlay Image', 'lyrico' ),
				'card-image-text'    => esc_html__( 'Text Under Image', 'lyrico' ),
				'list-item-simple'   => esc_html__( 'Simple list item', 'lyrico' ),
			),
		)
	);

	/**
	 * Albums Page Settings
	 */
	$wp_customize->add_section(
		'page_albums_settings_section',
		array(
			'title'           => esc_html__( 'Albums Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_albums_page',
		)
	);

	$wp_customize->add_setting(
		'page_albums_content_layout',
		array(
			'default'           => 'no-sidebar',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'page_albums_content_layout',
			array(
				'label'   => esc_html__( 'Albums Page Layout', 'lyrico' ),
				'section' => 'page_albums_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),

			)
		)
	);

	$wp_customize->add_setting(
		'page_albums_hide_featured_albums',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_albums_hide_featured_albums',
		array(
			'label'   => esc_html__( 'Hide Featured Albums', 'lyrico' ),
			'section' => 'page_albums_settings_section',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'page_albums_featured_albums_number',
		array(
			'default'           => 8,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'page_albums_featured_albums_number',
		array(
			'label'           => esc_html__( 'Featured Albums to show at most:', 'lyrico' ),
			'section'         => 'page_albums_settings_section',
			'type'            => 'number',
			'active_callback' => function() {
				return ! get_theme_mod( 'page_albums_hide_featured_albums', 0 );
			},
		)
	);

	$wp_customize->add_setting(
		'page_albums_featured_albums_style',
		array(
			'default'           => 'image-overlay',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_albums_featured_albums_style',
		array(
			'label'           => esc_html__( 'Featured Albums Style', 'lyrico' ),
			'section'         => 'page_albums_settings_section',
			'type'            => 'radio',
			'active_callback' => function() {
				return ! get_theme_mod( 'page_albums_hide_featured_albums', 0 );
			},
			'choices'         => array(
				'image-overlay' => esc_html__( 'Text Overlay Image', 'lyrico' ),
				'image-text'    => esc_html__( 'Text Under Image', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'page_albums_all_albums_number',
		array(
			'default'           => 24,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'page_albums_all_albums_number',
		array(
			'label'   => esc_html__( 'All Albums to show at most:', 'lyrico' ),
			'section' => 'page_albums_settings_section',
			'type'    => 'number',
		)
	);

	$wp_customize->add_setting(
		'page_albums_all_albums_style',
		array(
			'default'           => 'card-image-overlay',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_albums_all_albums_style',
		array(
			'label'   => esc_html__( 'All Albums Style', 'lyrico' ),
			'section' => 'page_albums_settings_section',
			'type'    => 'radio',
			'choices' => array(
				'card-image-overlay' => esc_html__( 'Text Overlay Image', 'lyrico' ),
				'card-image-text'    => esc_html__( 'Text Under Image', 'lyrico' ),
				'list-item-simple'   => esc_html__( 'Simple list item', 'lyrico' ),
			),
		)
	);

	/**
	 * Playlists Page Settings
	 */
	$wp_customize->add_section(
		'page_playlists_settings_section',
		array(
			'title'           => esc_html__( 'Playlists Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_playlists_page',
		)
	);

	$wp_customize->add_setting(
		'page_playlists_content_layout',
		array(
			'default'           => 'no-sidebar',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'page_playlists_content_layout',
			array(
				'label'   => esc_html__( 'Playlists Page Layout', 'lyrico' ),
				'section' => 'page_playlists_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'page_playlists_hide_featured_playlists',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_playlists_hide_featured_playlists',
		array(
			'label'   => esc_html__( 'Hide Featured Playlists', 'lyrico' ),
			'section' => 'page_playlists_settings_section',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'page_playlists_featured_playlists_number',
		array(
			'default'           => 8,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'page_playlists_featured_playlists_number',
		array(
			'label'           => esc_html__( 'Featured Playlists to show at most:', 'lyrico' ),
			'section'         => 'page_playlists_settings_section',
			'type'            => 'number',
			'active_callback' => function() {
				return ! get_theme_mod( 'page_playlists_hide_featured_playlists', 0 );
			},
		)
	);

	$wp_customize->add_setting(
		'page_playlists_featured_playlists_style',
		array(
			'default'           => 'image-overlay',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_playlists_featured_playlists_style',
		array(
			'label'           => esc_html__( 'Featured Playlists Style', 'lyrico' ),
			'section'         => 'page_playlists_settings_section',
			'type'            => 'radio',
			'active_callback' => function() {
				return ! get_theme_mod( 'page_playlists_hide_featured_playlists', 0 );
			},
			'choices'         => array(
				'image-overlay' => esc_html__( 'Text Overlay Image', 'lyrico' ),
				'image-text'    => esc_html__( 'Text Under Image', 'lyrico' ),
			),
		)
	);

	$wp_customize->add_setting(
		'page_playlists_all_playlists_number',
		array(
			'default'           => 24,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'page_playlists_all_playlists_number',
		array(
			'label'   => esc_html__( 'All Playlists to show at most:', 'lyrico' ),
			'section' => 'page_playlists_settings_section',
			'type'    => 'number',
		)
	);

	$wp_customize->add_setting(
		'page_playlists_all_playlists_style',
		array(
			'default'           => 'image-overlay',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'page_playlists_all_playlists_style',
		array(
			'label'   => esc_html__( 'All Playlists Style', 'lyrico' ),
			'section' => 'page_playlists_settings_section',
			'type'    => 'radio',
			'choices' => array(
				'image-overlay' => esc_html__( 'Text Overlay Image', 'lyrico' ),
				'image-text'    => esc_html__( 'Text Under Image', 'lyrico' ),
			),
		)
	);

	/**
	 * Single Lyrics Settings
	 */
	$wp_customize->add_section(
		'single_lyrics_settings_section',
		array(
			'title'           => esc_html__( 'Single Lyrics Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_single_lyrics',
		)
	);

	$wp_customize->add_setting(
		'single_lyrics_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'single_lyrics_content_layout',
			array(
				'label'   => esc_html__( 'Single Lyrics Layout', 'lyrico' ),
				'section' => 'single_lyrics_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'single_lyrics_fixed_embed',
		array(
			'default'           => 'youtube',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'single_lyrics_fixed_embed',
		array(
			'label'   => esc_html__( 'Fixed Embed after scroll down (only large devices)', 'lyrico' ),
			'section' => 'single_lyrics_settings_section',
			'type'    => 'radio',
			'choices' => array(
				'none'    => esc_html__( 'None', 'lyrico' ),
				'youtube' => esc_html__( 'Youtube', 'lyrico' ),
				'spotify' => esc_html__( 'Spotify', 'lyrico' ),
			),
		)
	);

	/**
	 * Single Album Settings
	 */
	$wp_customize->add_section(
		'single_album_settings_section',
		array(
			'title'           => esc_html__( 'Single Album Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_single_album',
		)
	);

	$wp_customize->add_setting(
		'single_album_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'single_album_content_layout',
			array(
				'label'   => esc_html__( 'Single Album Layout', 'lyrico' ),
				'section' => 'single_album_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	/**
	 * Single Artist Settings
	 */
	$wp_customize->add_section(
		'single_artist_settings_section',
		array(
			'title'           => esc_html__( 'Single Artist Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_single_artist',
		)
	);

	$wp_customize->add_setting(
		'single_artist_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'single_artist_content_layout',
			array(
				'label'   => esc_html__( 'Single Artist Layout', 'lyrico' ),
				'section' => 'single_artist_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	/**
	 * Single Playlist Settings
	 */
	$wp_customize->add_section(
		'single_playlist_settings_section',
		array(
			'title'           => esc_html__( 'Single Playlist Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_single_playlist',
		)
	);

	$wp_customize->add_setting(
		'single_playlist_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'single_playlist_content_layout',
			array(
				'label'   => esc_html__( 'Single Playlist Layout', 'lyrico' ),
				'section' => 'single_playlist_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	/**
	 * Genres Page Template Settings
	 */
	$wp_customize->add_section(
		'page_genres_settings_section',
		array(
			'title'           => esc_html__( 'Genres Layout &#x26; Settings', 'lyrico' ),
			'priority'        => 1,
			'active_callback' => 'is_it_genres_page',
		)
	);
	$wp_customize->add_setting(
		'page_genres_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'page_genres_content_layout',
			array(
				'label'   => esc_html__( 'Genres Page Layout', 'lyrico' ),
				'section' => 'page_genres_settings_section',
				'choices' => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	/*
	-------------------------------------------*
	*------- Panel: Site Layout & Settings -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_panel(
		'layout_settings',
		array(
			'title'    => esc_html__( 'Site Layout  &#x26; Settings', 'lyrico' ),
			'priority' => 2,
		)
	);

	/*
	-------------------------------------------*
	*------- Section: General Layout ( in Site Layout & Settings Panel ) -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_section(
		'general_layout',
		array(
			'title' => esc_html__( 'General', 'lyrico' ),
			'panel' => 'layout_settings',
		)
	);

	$wp_customize->add_setting(
		'go_top_button',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'go_top_button',
		array(
			'label'   => esc_html__( 'Activate Go Top Button', 'lyrico' ),
			'section' => 'general_layout',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'go_top_button_description',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Description_With_Image(
			$wp_customize,
			'go_top_button_description',
			array(
				'type'        => 'image_description',
				'section'     => 'general_layout',
				'description' => esc_html__( 'This &#x22;Go top&#x22; button allows users to smoothly scroll back to the top of the page. This button appears when the user scrolls down', 'lyrico' ),
			)
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Top Navigation ( in Site Layout & Settings Panel ) -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_section(
		'navbar_settings',
		array(
			'title' => esc_html__( 'Navigation', 'lyrico' ),
			'panel' => 'layout_settings',
		)
	);

	$wp_customize->add_setting(
		'navbar_layout',
		array(
			'default'           => 'navbar-1',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'navbar_layout',
			array(
				'label'   => esc_html__( 'Navbar Layout', 'lyrico' ),
				'section' => 'navbar_settings',
				'choices' => array(
					'navbar-1' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-1.png' ),
						'name'  => __( 'Modal menu Navbar', 'lyrico' ),
					),
					'navbar-2' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-2.png' ),
						'name'  => __( 'Simple Navbar', 'lyrico' ),
					),
					'navbar-3' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-3.png' ),
						'name'  => __( 'Double Row Navbar', 'lyrico' ),
					),
					'navbar-4' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-4.png' ),
						'name'  => __( 'Double Row Navbar with slider', 'lyrico' ),
					),
					'navbar-5' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-5.png' ),
						'name'  => __( 'Double Row Navbar with slider', 'lyrico' ),
					),
					'navbar-6' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-6.png' ),
						'name'  => __( 'One Row Navbar with menu slider', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'top_navbar_color',
		array(
			'default'           => '#f8f9fa',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_navbar_color',
			array(
				'label'   => esc_html__( 'Top Navbar Color', 'lyrico' ),
				'section' => 'navbar_settings',
			)
		)
	);

	// light means Dark text.
	$wp_customize->add_setting(
		'top_navbar_text_color',
		array(
			'default'           => 'light',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'top_navbar_text_color',
			array(
				'label'   => esc_html__( 'Top Navbar Text Color', 'lyrico' ),
				'section' => 'navbar_settings',
				'choices' => array(
					'dark'  => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-light.png' ),
						'name'  => __( 'Light Text Color', 'lyrico' ),
					),
					'light' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-dark.png' ),
						'name'  => __( 'Dark Text Color', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'top_navbar_padding',
		array(
			'default'           => 10,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Slider_Custom_Control(
			$wp_customize,
			'top_navbar_padding',
			array(
				'label'       => esc_html__( 'Top Navbar Padding (Top/Bottom)', 'lyrico' ),
				'type'        => 'range',
				'section'     => 'navbar_settings',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'top_secondary_navbar_color',
		array(
			'default'           => '#007cf9',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_secondary_navbar_color',
			array(
				'label'           => esc_html__( 'Top - Second Navbar Color', 'lyrico' ),
				'section'         => 'navbar_settings',
				'active_callback' => 'is_second_navbar_active',
			)
		)
	);

	$wp_customize->add_setting(
		'top_secondary_navbar_text_color',
		array(
			'default'           => 'light',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'top_secondary_navbar_text_color',
			array(
				'label'           => esc_html__( 'Top - Second Navbar Text Color', 'lyrico' ),
				'section'         => 'navbar_settings',
				'choices'         => array(
					'dark'  => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-light.png' ),
						'name'  => __( 'Light Text Color', 'lyrico' ),
					),
					'light' => array(
						'image' => get_theme_file_uri( 'assets/images/navbar-dark.png' ),
						'name'  => __( 'Dark Text Color', 'lyrico' ),
					),
				),
				'active_callback' => 'is_second_navbar_active',
			)
		)
	);

	$wp_customize->add_setting(
		'top_secondary_navbar_padding',
		array(
			'default'           => 5,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Slider_Custom_Control(
			$wp_customize,
			'top_secondary_navbar_padding',
			array(
				'label'           => esc_html__( 'Top - Second Navbar Padding (Top/Bottom)', 'lyrico' ),
				'type'            => 'range',
				'section'         => 'navbar_settings',
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
				'active_callback' => 'is_second_navbar_active',
			)
		)
	);

	$wp_customize->add_setting(
		'show_social_media_icons_on_top',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_Control(
			$wp_customize,
			'show_social_media_icons_on_top',
			array(
				'type'    => 'checkbox',
				'section' => 'navbar_settings',
				'label'   => esc_html__( 'Show Social Media icons', 'lyrico' ),
			)
		)
	);

	$wp_customize->add_setting(
		'show_social_with_brand_colors',
		array(
			'default'           => 1,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'show_social_with_brand_colors',
		array(
			'label'           => esc_html__( 'Social media icons with brand color', 'lyrico' ),
			'section'         => 'navbar_settings',
			'type'            => 'checkbox',
			'active_callback' => 'is_social_allowed',
		)
	);

	$wp_customize->add_setting(
		'top_navbar_fixed',
		array(
			'default'           => 0,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_Control(
			$wp_customize,
			'top_navbar_fixed',
			array(
				'type'        => 'checkbox',
				'section'     => 'navbar_settings',
				'description' => 'Will be shown when Scrolling Up',
				'label'       => esc_html__( 'Fixed Navbar', 'lyrico' ),
			)
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Content Header ( in Site Layout & Settings Panel ) -------*
	*--------------------------------------------*
	*/

	$wp_customize->add_section(
		'content_header_layout',
		array(
			'title' => esc_html__( 'Header', 'lyrico' ),
			'panel' => 'layout_settings',
		)
	);

	$wp_customize->add_setting(
		'header_background_template',
		array(
			'default'           => 'midnight-city',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'header_background_template',
			array(
				'label'   => esc_html__( 'Header Background Template', 'lyrico' ),
				'section' => 'content_header_layout',
				'choices' => array(
					'midnight-city'    => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/midnight-city.png' ),
						'name'  => __( 'Midnight City', 'lyrico' ),
					),
					'mild'             => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/mild.png' ),
						'name'  => __( 'Mild', 'lyrico' ),
					),
					'copper'           => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/copper.png' ),
						'name'  => __( 'Cooper', 'lyrico' ),
					),
					'moonlit-asteroid' => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/moonlit-asteroid.png' ),
						'name'  => __( 'Moonlit Asteroid', 'lyrico' ),
					),
					'delicate'         => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/delicate.png' ),
						'name'  => __( 'Delicate', 'lyrico' ),
					),
					'mauve'            => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/mauve.png' ),
						'name'  => __( 'Mauve', 'lyrico' ),
					),
					'ash'              => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/ash.png' ),
						'name'  => __( 'Ash', 'lyrico' ),
					),
					'disco'            => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/disco.png' ),
						'name'  => __( 'Disco', 'lyrico' ),
					),
					'rosenna'          => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/rosenna.png' ),
						'name'  => __( 'Rosenna', 'lyrico' ),
					),
					'love-and-liberty' => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/love-and-liberty.png' ),
						'name'  => __( 'Love and Liberty', 'lyrico' ),
					),
					'namn'             => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/namn.png' ),
						'name'  => __( 'Namn', 'lyrico' ),
					),
					'orca'             => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/orca.png' ),
						'name'  => __( 'Orca', 'lyrico' ),
					),
					'mango'            => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/mango.png' ),
						'name'  => __( 'Mango', 'lyrico' ),
					),
					'purple'           => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/purple.png' ),
						'name'  => __( 'Purple', 'lyrico' ),
					),
					'love-couple'      => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/love-couple.png' ),
						'name'  => __( 'Love Couple', 'lyrico' ),
					),
					'limade'           => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/limade.png' ),
						'name'  => __( 'Limade', 'lyrico' ),
					),
					'under-lake'       => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/under-lake.png' ),
						'name'  => __( 'Under Lake', 'lyrico' ),
					),
					'feel-the-love'    => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/feel-the-love.png' ),
						'name'  => __( 'Feel the Love', 'lyrico' ),
					),
					'firewatch'        => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/firewatch.png' ),
						'name'  => __( 'Firewatch', 'lyrico' ),
					),
					'portrait'         => array(
						'image' => get_theme_file_uri( 'assets/images/gradients/portrait.png' ),
						'name'  => __( 'Portrait', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'header_custom_background_css',
		array(
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'wp_filter_nohtml_kses',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'header_custom_background_css',
		array(
			'label'       => esc_html__( 'Custom Background', 'lyrico' ),
			'description' => esc_url( 'https://uigradients.com' ),
			'section'     => 'content_header_layout',
			'type'        => 'textarea',
			'capability'  => 'edit_theme_options',
			'input_attrs' => array(
				'style'       => 'border: 1px solid #999',
				'placeholder' => esc_html( 'background: teal; color: black;' ),
			),
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Content Layout ( in Site Layout & Settings Panel ) -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_setting(
		'full_width_content',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'full_width_content',
		array(
			'label'   => esc_html__( 'Full Width Content', 'lyrico' ),
			'section' => 'content_layout',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'modular_design',
		array(
			'default'           => 1,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'modular_design',
		array(
			'label'   => esc_html__( 'Activate Modules', 'lyrico' ),
			'section' => 'content_layout',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'site_content_margin_top_mobile',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_setting(
		'site_content_margin_top_tablet',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_setting(
		'site_content_margin_top',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Slider_Custom_Control_With_Responsive(
			$wp_customize,
			'site_content_margin_top',
			array(
				'label'           => esc_html__( 'Site Content Margin Top', 'lyrico' ),
				'description'     => esc_html__( 'Space between header and content.', 'lyrico' ),
				'type'            => 'lyrico_range_control',
				'section'         => 'content_layout',
				'settings'        => [
					'mobile_devices' => 'site_content_margin_top_mobile',
					'tablets'        => 'site_content_margin_top_tablet',
					'other_devices'  => 'site_content_margin_top',
				],
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'site_content_margin_bottom_mobile',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_setting(
		'site_content_margin_bottom_tablet',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_setting(
		'site_content_margin_bottom',
		array(
			'default'           => 15,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Lyrico_Slider_Custom_Control_With_Responsive(
			$wp_customize,
			'site_content_margin_bottom',
			array(
				'label'           => esc_html__( 'Site Content Margin Bottom', 'lyrico' ),
				'description'     => esc_html__( 'Space between content and footer.', 'lyrico' ),
				'type'            => 'lyrico_range_control',
				'section'         => 'content_layout',
				'settings'        => [
					'mobile_devices' => 'site_content_margin_bottom_mobile',
					'tablets'        => 'site_content_margin_bottom_tablet',
					'other_devices'  => 'site_content_margin_bottom',
				],
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_section(
		'content_layout',
		array(
			'title' => esc_html__( 'Content', 'lyrico' ),
			'panel' => 'layout_settings',
		)
	);

	$wp_customize->add_setting(
		'latest_posts_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'latest_posts_content_layout',
			array(
				'label'       => esc_html__( 'Posts Page Layout', 'lyrico' ),
				'section'     => 'content_layout',
				'description' => 'That will be applied to Blog posts(Latest Posts) page.',
				'choices'     => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'not_found_content_layout',
		array(
			'default'           => 'no-sidebar',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'not_found_content_layout',
			array(
				'label'       => esc_html__( '404 Page Layout', 'lyrico' ),
				'section'     => 'content_layout',
				'description' => 'That will be applied to the 404 error page on your site. This page does not appear in the Customizer.',
				'choices'     => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'archive_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'archive_content_layout',
			array(
				'label'       => esc_html__( 'Archive Page Layout', 'lyrico' ),
				'section'     => 'content_layout',
				'description' => 'That will be applied to Category, Tag and Archive pages.',
				'choices'     => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'page_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'page_content_layout',
			array(
				'label'       => esc_html__( 'Default Page Layout', 'lyrico' ),
				'section'     => 'content_layout',
				'description' => 'That will be applied to the Default Template Pages.',
				'choices'     => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'blog_content_layout',
		array(
			'default'           => 'sidebar-right',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'blog_content_layout',
			array(
				'label'       => esc_html__( 'Single Blog Post Layout', 'lyrico' ),
				'section'     => 'content_layout',
				'description' => 'That will be applied to Single Blog Posts.',
				'choices'     => array(
					'sidebar-left'  => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-left.png' ),
						'name'  => __( 'Left Sidebar', 'lyrico' ),
					),
					'no-sidebar'    => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-no.png' ),
						'name'  => __( 'No Sidebar', 'lyrico' ),
					),
					'sidebar-right' => array(
						'image' => get_theme_file_uri( 'assets/images/sidebar-right.png' ),
						'name'  => __( 'Right Sidebar', 'lyrico' ),
					),
				),
			)
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Footer Layout ( in Site Layout & Settings Panel ) -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_section(
		'footer_settings',
		array(
			'title' => esc_html__( 'Footer', 'lyrico' ),
			'panel' => 'layout_settings',
		)
	);

	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'           => 'Copyright. 2019 Lyrico.',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'label'   => esc_html__( 'Footer Copyright Text', 'lyrico' ),
			'section' => 'footer_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'hide_footer_brand',
		array(
			'default'           => 0,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		'hide_footer_brand',
		array(
			'label'   => esc_html__( 'Hide Brand in footer.', 'lyrico' ),
			'section' => 'footer_settings',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'default'           => '#f8f9fa',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			array(
				'label'   => esc_html__( 'Footer Background Color', 'lyrico' ),
				'section' => 'footer_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default'           => '#212529',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'label'   => esc_html__( 'Footer Text Color', 'lyrico' ),
				'section' => 'footer_settings',
			)
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Social Media URLs -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_section(
		'social_media_settings',
		array(
			'title' => esc_html__( 'Social Media URLs', 'lyrico' ),
		)
	);

	/**
	 * Social site icons for Quick Menu bar
	 *
	 * @link: https://www.competethemes.com/social-icons-wordpress-menu-theme-customizer/
	 */

	$social_media_sites = lyrico_get_social_media_sites();
	$priority           = 5;

	foreach ( $social_media_sites as $social_media_site ) {

		$wp_customize->add_setting(
			"$social_media_site",
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			$social_media_site,
			array(
				'label'    => ucwords( sprintf( /* translators: 1: social site. */ esc_html__( '%s URL:', 'lyrico' ), $social_media_site ) ),
				'section'  => 'social_media_settings',
				'type'     => 'text',
				'priority' => $priority,
			)
		);

		$priority += 5;
	}

	/*
	-------------------------------------------*
	*------- Section: Google Fonts -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_section(
		'google_fonts',
		array(
			'title' => esc_html__( 'Google Fonts', 'lyrico' ),
		)
	);

	$wp_customize->add_setting(
		'google_font_activation',
		array(
			'default'           => 0,
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_Control(
			$wp_customize,
			'google_font_activation',
			array(
				'label'       => esc_html__( 'Google Fonts', 'lyrico' ),
				'section'     => 'google_fonts',
				'description' => esc_html__( 'Lyrico uses Bootstrap 4 default font family if Google Fonts not active.', 'lyrico' ),
				'type'        => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fonts_body',
		array(
			'default'           => wp_json_encode(
				array(
					'font'          => 'Open Sans',
					'thinweight'    => '300',
					'regularweight' => 'regular',
					'boldweight'    => '700',
					'category'      => 'sans-serif',
				)
			),
			'sanitize_callback' => 'skyrocket_google_font_sanitization',
		)
	);

	$wp_customize->add_control(
		new Skyrocket_Google_Font_Select_Custom_Control(
			$wp_customize,
			'google_fonts_body',
			array(
				'label'       => esc_html__( 'Select Google Font', 'lyrico' ),
				'description' => esc_html__( '19 Google Fonts sorted by popularity and compatibility.', 'lyrico' ),
				'section'     => 'google_fonts',
				'input_attrs' => array(
					'font_count' => 'all',
					'orderby'    => 'popular',
				),
			)
		)
	);

	/*
	-------------------------------------------*
	*------- Section: Colors -------*
	*--------------------------------------------*
	*/
	$wp_customize->add_setting(
		'main_container_background_color',
		array(
			'default'           => '#fff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_container_background_color',
			array(
				'description'     => 'Background color of Content Area. ( Default: #fff )',
				'label'           => esc_html__( 'Main Container Background Color', 'lyrico' ),
				'section'         => 'colors',
				'active_callback' => function() {
						return ! get_theme_mod( 'modular_design', 1 );
				},
			)
		)
	);

	$wp_customize->add_setting(
		'module_background_color',
		array(
			'default'           => '#fff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'module_background_color',
			array(
				'description'     => 'If modular design active. ( Default: #fff )',
				'label'           => esc_html__( 'Module Background Color', 'lyrico' ),
				'section'         => 'colors',
				'active_callback' => function() {
						return get_theme_mod( 'modular_design', 1 );
				},
			)
		)
	);


		$wp_customize->add_setting(
			'module_header_color',
			array(
				'default'           => '#212529',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'module_header_color',
				array(
					'label'           => esc_html__( 'Module Header Color', 'lyrico' ),
					'section'         => 'colors',
					'active_callback' => function() {
							return get_theme_mod( 'modular_design', 1 );
					},
				)
			)
		);

	$wp_customize->add_setting(
		'content_text_color',
		array(
			'default'           => '#212529',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_text_color',
			array(
				'description' => ' ( Default: #212529 )',
				'label'       => esc_html__( 'Content Text Color.', 'lyrico' ),
				'section'     => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'button_color_template',
		array(
			'default'           => 'outline-dark',
			'sanitize_callback' => 'skyrocket_radio_sanitization',
		)
	);

	$wp_customize->add_control(
		'button_color_template',
		array(
			'label'       => esc_html__( 'Button Color Template:', 'lyrico' ),
			'section'     => 'colors',
			'type'        => 'radio',
			'description' => 'Effects read more button, post genres, see all buttons',
			'choices'     => array(
				'dark'              => esc_html__( 'Dark', 'lyrico' ),
				'secondary'         => esc_html__( 'Gray', 'lyrico' ),
				'light'             => esc_html__( 'Light', 'lyrico' ),
				'outline-dark'      => esc_html__( 'Outlined Dark', 'lyrico' ),
				'outline-secondary' => esc_html__( 'Outlined Gray', 'lyrico' ),
				'outline-light'     => esc_html__( 'Outlined Light', 'lyrico' ),
			),
		)
	);

}
add_action( 'customize_register', 'lyrico_customize_register' );

/**
 * Custom control styles.
 * https://codex.wordpress.org/Plugin_API/Action_Reference/customize_controls_print_styles
 */
function lyrico_customizer_custom_control_css() {
	?>
		<style>
		.customize-control-radio-image .image.ui-buttonset input[type=radio] {
			height: auto;
		}
		.customize-control-radio-image .image.ui-buttonset label {
			display: inline-block;
			margin-right: 8px;
			margin-bottom: 10px;
		}
		.customize-control-radio-image .image.ui-buttonset label.ui-state-active {
			background: none;
		}
		.customize-control-radio-image .customize-control-radio-buttonset label {
			padding: 5px 10px;
			background: #f7f7f7;
			border-left: 1px solid #dedede;
			line-height: 35px;
		}
		.customize-control-radio-image label img {
			border: 1px solid #bbb;
			opacity: 0.6;
			border-radius: .25rem;
			transition: all .25s ease-in-out;
			box-shadow: 0px 1px 1px #444;
		}
		#customize-controls .customize-control-radio-image label img {
			width: 100%;
			max-height: 50px;
			height: auto;
		}
		.customize-control-radio-image label.ui-state-active img {
			background: #dedede;
			border-color: #0e5556;
			opacity: 1;
		}
		.customize-control-radio-image label.ui-state-hover img {
			opacity: 0.9;
			border-color: #999;
		}
		.customize-control-radio-buttonset label.ui-corner-left {
			border-radius: 3px 0 0 3px;
			border-left: 0;
		}
		.customize-control-radio-buttonset label.ui-corner-right {
			border-radius: 0 3px 3px 0;
		}
		.lyrico-description-with-image{
			padding: 8px;
			border: 1px solid #ddd;
			border-radius: 10px;
		}
		.lyrico-description-with-image img{
			display: block;
			border: 1px solid #bbb;
			border-radius: .25rem;
			margin: .75rem 0;
		}
		.lyrico-description-with-image .customize-control-description{
			font-size: 12px;
		}

		.lyrico-device-select-button{
			opacity: .6;
			font-size: 20px;
			background-color: #555;
			color: #bbb;
			border-radius: 50%;
			padding: 5px;
		}
		.ui-state-active .lyrico-device-select-button{
			opacity: 1;
			border: 2px solid #222;
		}
		.lyrico-device-select-tabs .ui-tabs-nav li{
			list-style: none;
			float: left;
			position: relative;
			top: 0;
			margin: 4px .2em 4px 0;
			border-radius: 50%;
			padding: 0;
			white-space: nowrap;
		}
		.lyrico-device-select-tabs .ui-tabs-nav li .lyrico-device-select-button{
			outline: 0;
		}
		.lyrico-device-select-tabs .lyrico-device-select-button:hover{
			color: #bbb;
			opacity: .8;
		}
		.lyrico-device-select-tabs .lyrico-device-select-button:focus{
			box-shadow: none;
			color: #bbb;
		}
		.ui-helper-clearfix:before, .ui-helper-clearfix:after{
			content: "";
			display: table;
			border-collapse: collapse;
		}
		.ui-helper-clearfix:after{
			clear: both;
		}
		.ui-helper-clearfix:before, .ui-helper-clearfix:after {
			content: "";
			display: table;
			border-collapse: collapse;
		}
		.customize-control-lyrico_range_control{
			border-top: 1px solid #ccc;
			padding-top: 10px;
		}
		</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'lyrico_customizer_custom_control_css' );

/**
 * Add Custom Styles into the header.
 */
function lyrico_customizer_css() {
	?>
		<style type="text/css">
		<?php
		if ( get_theme_mod( 'google_font_activation', 0 ) === 1 ) :
			$json      = get_theme_mod( 'google_fonts_body' );
			$body_font = json_decode( $json );
			?>
			body {
				font-family: '<?php echo esc_html( $body_font->font ); ?>', <?php echo esc_html( $body_font->category ); ?>;
				font-weight: <?php echo esc_html( str_replace( 'regular', '400', $body_font->regularweight ) ); ?>;
			}

			b, strong, .navbar-brand, .menu-item, .post-navigation .meta-nav, .screen-reader-text:focus, .badge, .lyrico-widget-style-simple-list,
			.lyrico-widget-style-simple-list-ordered, .widget-title h5, .widget_calendar caption, #reply-title, #cancel-comment-reply-link,
			.comment-reply a, .primary-media-title, .secondary-media-title, .order-box-number, .album-year, .lyrico-blog-post .post-date,
			.lyrico-genre-link a, .entry-meta, .entry-footer, .artist-albums small, .artist-albums .album-ordering, #home-news .media-body,
			.page-links > .page-link-number, .page-numbers.current, .btn, .entry .entry-content .wp-block-button .wp-block-button__link,
			.entry .entry-content .wp-block-search label, .entry .entry-content .wp-block-archives li, .entry .entry-content .wp-block-categories li,
			.entry .entry-content .wp-block-latest-posts li, .entry .entry-content .wp-block-latest-comments .wp-block-latest-comments__comment-author,
			.widget_tag_cloud .tagcloud, .widget_archive ul li, .widget_categories ul li, .widget_meta ul li, .widget_recent_comments ul li,
			.widget_recent_entries ul li, .widget_nav_menu ul li, .widget_pages ul li, .widget_rss ul li, body.logged-in .post-edit-link,
			th, #other-songs-from-the-album-module a, .lyrico-blog-post .entry-excerpt, .module-header h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6, .wp-block-lyrico-playlist-item .playlist-item-media {
				font-weight: <?php echo esc_html( str_replace( 'regular', '400', $body_font->boldweight ) ); ?>;
			}

			.lyrico-site-header h1 {
				font-weight: <?php echo esc_html( str_replace( 'regular', '400', $body_font->thinweight ) ); ?>;
			}
			<?php
		endif;
		?>
			.main-container {
				color: <?php echo esc_html( get_theme_mod( 'content_text_color', '#212529' ) ); ?>;
			}
			.site-footer-container{
				background: <?php echo esc_html( get_theme_mod( 'footer_background_color', '#f8f9fa' ) ); ?> ;
				color: <?php echo esc_html( get_theme_mod( 'footer_text_color', '#212529' ) ); ?> ;
			}
			.navbar-top { background: <?php echo esc_html( get_theme_mod( 'top_navbar_color', '#f4f4f4' ) ); ?>; }

			.navbar-top-secondary { background: <?php echo esc_html( get_theme_mod( 'top_secondary_navbar_color', '#007cf9' ) ); ?>; }
			.navbar-top {
				padding-top: <?php echo esc_html( get_theme_mod( 'top_navbar_padding', 10 ) . 'px' ); ?>;
				padding-bottom: <?php echo esc_html( get_theme_mod( 'top_navbar_padding', 10 ) . 'px' ); ?>;
			}
			.navbar-top-secondary {
				padding-top: <?php echo esc_html( get_theme_mod( 'top_secondary_navbar_padding', 5 ) . 'px' ); ?>;
				padding-bottom: <?php echo esc_html( get_theme_mod( 'top_secondary_navbar_padding', 5 ) . 'px' ); ?>;
			}

			body.modular-design .lyrico-module, body.modular-design #secondary-div .widget, body.modular-design .lyrico-blog-post {
				background-color: <?php echo esc_html( get_theme_mod( 'module_background_color', '#fff' ) ); ?>;
			}

			body.modular-design .lyrico-module .module-header, body.modular-design #secondary-div .widget .widget-title, body.modular-design .lyrico-blog-post .card-title{
				color: <?php echo esc_html( get_theme_mod( 'module_header_color', '#212529' ) ); ?>;
			}

			body:not(.modular-design) .main-container{
				background-color: <?php echo esc_html( get_theme_mod( 'main_container_background_color', '#fff' ) ); ?>;
			}
			.main-container {
				margin-top: <?php echo esc_html( get_theme_mod( 'site_content_margin_top_mobile', 0 ) . 'px' ); ?>;
				margin-bottom: <?php echo esc_html( get_theme_mod( 'site_content_margin_bottom_mobile', 0 ) . 'px' ); ?>;
			}
			@media (min-width: 576px) {
				.main-container {
					margin-top: <?php echo esc_html( get_theme_mod( 'site_content_margin_top_tablet', 0 ) . 'px' ); ?>;
					margin-bottom: <?php echo esc_html( get_theme_mod( 'site_content_margin_bottom_tablet', 0 ) . 'px' ); ?>;
				}
			}

			@media (min-width: 992px) {
				.main-container {
					margin-top: <?php echo esc_html( get_theme_mod( 'site_content_margin_top', 0 ) . 'px' ); ?>;
					margin-bottom: <?php echo esc_html( get_theme_mod( 'site_content_margin_bottom', 15 ) . 'px' ); ?>;
				}
			}

			.single-header-container, .page-header-container {
				<?php echo esc_textarea( get_theme_mod( 'header_custom_background_css', '' ) ); ?>
			}
		</style>
	<?php
}
add_action( 'wp_head', 'lyrico_customizer_css' );

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function lyrico_customize_preview_js() {
	wp_enqueue_script( 'lyrico-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'lyrico_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function lyrico_customize_script() {
	wp_enqueue_script( 'lyrico-customize-controls', get_theme_file_uri( '/assets/js/customizer.js' ), array(), '1.0', true );

	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-effects-fade' );
}
add_action( 'customize_controls_enqueue_scripts', 'lyrico_customize_script' );

/**
 * Return true if navbar has Double Row.
 */
function is_second_navbar_active() {
	$navbar_layout = get_theme_mod( 'navbar_layout', 'navbar-1' );
	if ( 'navbar-3' === $navbar_layout || 'navbar-4' === $navbar_layout || 'navbar-5' === $navbar_layout ) {
		return true; } else {
		return false; }
}

/**
 * Return true if Show Social media icons setting is active.
 */
function is_social_allowed() {
	return get_theme_mod( 'show_social_media_icons_on_top', 1 );
}

/**
 * Return true if Full Width content setting is active.
 */
function is_not_full_width_layout() {
	return ! get_theme_mod( 'full_width_content', 0 );
}

/**
 * Return true if current page is Artists template.
 */
function is_it_artists_page() {
	return is_page_template( 'page-artists.php' );
}

/**
 * Return true if current page is Albums template.
 */
function is_it_albums_page() {
	return is_page_template( 'page-albums.php' );
}

/**
 * Return true if current page is Playlists template.
 */
function is_it_playlists_page() {
	return is_page_template( 'page-playlists.php' );
}

/**
 * Return true if current page is Genres template.
 */
function is_it_genres_page() {
	return is_page_template( 'lyrico-genres.php' );
}

/**
 * Return true if current page is Lyrico Home template.
 */
function is_it_lyrico_home() {
	return is_page_template( 'lyrico-home.php' );
}

/**
 * Return true if current page is a Single Lyrics.
 */
function is_it_single_lyrics() {
	return is_singular( 'lyrico_lyrics' );
}

/**
 * Return true if current page is a Single Artist.
 */
function is_it_single_artist() {
	return is_singular( 'lyrico_artist' );
}

/**
 * Return true if current page is a Single Album.
 */
function is_it_single_album() {
	return is_singular( 'lyrico_album' );
}

/**
 * Return true if current page is a Single Playlist.
 */
function is_it_single_playlist() {
	return is_singular( 'lyrico_playlist' );
}
