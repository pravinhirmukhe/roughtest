<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Theme's Function
 *
 */

/*
 * Setup and registration functions
 */
function silverclean_setup(){

	/* Set default $content_width */
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 450;

	/* Translation support
	 * Translations can be added to the /languages directory.
	 * A .pot template file is included to get you started
	 */
	load_theme_textdomain('silverclean-lite', get_template_directory() . '/languages');

	/* Feed links support */
	add_theme_support( 'automatic-feed-links' );

	/* Register Primary menu */
	register_nav_menu( 'primary', 'Navigation menu' );

	/* Title tag support */
	add_theme_support( 'title-tag' );

	/* Post Thumbnails Support */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 9999 ); // Unlimited height, soft crop

	/* Custom header support */
	add_theme_support( 'custom-header',
						array(	'header-text' => false,
								'width' => 962,
								'height' => 400,
								'flex-height' => true,
								)
					);

}
add_action('after_setup_theme', 'silverclean_setup');

/* Adjust $content_width it depending on the page being displayed */
function silverclean_content_width() {
	if ( is_page_template( 'page-full-width.php' ) ) {
		global $content_width;
		$content_width = 920;
	}
}
add_action( 'template_redirect', 'silverclean_content_width' );

/*
 * Add a home link to wp_page_menu() ( wp_nav_menu() fallback )
 */
function silverclean_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'silverclean_page_menu_args' );

/*
 * Register Sidebar and Footer widgetized areas
 */
function silverclean_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'silverclean-lite' ),
		'id'            => 'sidebar',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);

	register_sidebar( array(
		'name'          => __( 'Footer', 'silverclean-lite' ),
		'id'            => 'footer-sidebar',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'silverclean_widgets_init' );

/*
 * Enqueue CSS styles
 */
function silverclean_styles() {

	$template_directory_uri = get_template_directory_uri(); // Parent theme URI
	$stylesheet_directory = get_stylesheet_directory(); // Current theme directory
	$stylesheet_directory_uri = get_stylesheet_directory_uri(); // Current theme URI

	$responsive_mode = get_theme_mod('silverclean_responsive_mode');

	if ($responsive_mode != 'off'):
		$stylesheet = '/css/silverclean.dev.css';
	else:
		$stylesheet = '/css/silverclean-unresponsive.min.css';
	endif;

	/* Child theme support:
	 * Enqueue child-theme's versions of stylesheets in /css if they exist,
	 * or the parent theme's version otherwise
	 */
	if ( @file_exists( $stylesheet_directory . $stylesheet ) )
		wp_register_style( 'silverclean', $stylesheet_directory_uri . $stylesheet );
	else
		wp_register_style( 'silverclean', $template_directory_uri . $stylesheet );

	// Always enqueue style.css from the current theme
	wp_register_style( 'silverclean-style', $stylesheet_directory_uri . '/style.css');

	wp_enqueue_style( 'silverclean' );
	wp_enqueue_style( 'silverclean-style' );
}
add_action('wp_enqueue_scripts', 'silverclean_styles');

/*
 * Register editor style
 */
function silverclean_editor_styles() {
	add_editor_style('css/editor-style.css');
}
add_action( 'init', 'silverclean_editor_styles' );

/*
 * Enqueue Javascripts
 */
function silverclean_scripts() {
	wp_enqueue_script('silverclean', get_template_directory_uri() . '/js/silverclean.min.js', array('jquery','hoverIntent'));
    /* Threaded comments support */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'silverclean_scripts');

/*
 * Remove hentry class from static pages
 */
function silverclean_remove_hentry( $classes ) {
	if ( is_page() ):
		$classes = array_diff($classes, array('hentry'));
	endif;
	return $classes;
}
add_filter('post_class','silverclean_remove_hentry');

/*
 * Remove "rel" tags in category links (HTML5 invalid)
 */
function silverclean_remove_rel_cat( $text ) {
	$text = str_replace(' rel="category"', "", $text); return $text;
}
add_filter( 'the_category', 'silverclean_remove_rel_cat' );

/*
 * Customize "read more" links on index view
 */
function silverclean_excerpt_more( $more ) {
	global $post;
	return '... <div class="read-more"><a href="'. get_permalink( get_the_ID() ) . '">'. __("Read More", 'silverclean-lite') .'</a></div>';
}
add_filter( 'excerpt_more', 'silverclean_excerpt_more' );

function silverclean_content_more( $more ) {
	global $post;
	return '<div class="read-more"><a href="'. get_permalink() . '#more-' . $post->ID . '">'. __("Read More", 'silverclean-lite') .'</a></div>';
}
add_filter( 'the_content_more_link', 'silverclean_content_more' );

/*
 * Rewrite and replace wp_trim_excerpt() so it adds a relevant read more link
 * when the <!--more--> or <!--nextpage--> quicktags are used
 * This new function preserves every features and filters from the original wp_trim_excerpt
 */
function silverclean_trim_excerpt($text = '') {
	global $post;
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

		/* If the post_content contains a <!--more--> OR a <!--nextpage--> quicktag
		 * AND the more link has not been added already
		 * then we add it now
		 */
		if ( ( preg_match('/<!--more(.*?)?-->/', $post->post_content ) || preg_match('/<!--nextpage-->/', $post->post_content ) ) && strpos($text,$excerpt_more) === false ) {
		 $text .= $excerpt_more;
		}

	}
	return apply_filters('silverclean_trim_excerpt', $text, $raw_excerpt);
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt'  );
add_filter( 'get_the_excerpt', 'silverclean_trim_excerpt' );


/*
 * Create dropdown menu (used in responsive mode)
 * Requires a custom menu to be set (won't work with fallback menu)
 */
function silverclean_dropdown_nav_menu () {
	$menu_name = 'primary';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		if ($menu = wp_get_nav_menu_object( $locations[ $menu_name ] ) ) {
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '<select id="dropdown-menu">';
		$menu_list .= '<option value="">Menu</option>';
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			if($url != "#" ) $menu_list .= '<option value="' . $url . '">' . $title . '</option>';
		}
		$menu_list .= '</select>';
   		// $menu_list now ready to output
   		echo $menu_list;
		}
    }
}

/*
 * Find whether post page needs comments pagination links (used in comments.php)
 */
function silverclean_page_has_comments_nav() {
	global $wp_query;
	return ($wp_query->max_num_comment_pages > 1);
}

/*
 * Find whether attachement page needs navigation links (used in single.php)
 */
function silverclean_adjacent_image_link($prev = true) {
    global $post;
    $post = get_post($post);
    $attachments = array_values(get_children("post_parent=$post->post_parent&post_type=attachment&post_mime_type=image&orderby=\"menu_order ASC, ID ASC\""));

    foreach ( $attachments as $k => $attachment )
        if ( $attachment->ID == $post->ID )
            break;

    $k = $prev ? $k - 1 : $k + 1;

    if ( isset($attachments[$k]) )
        return true;
	else
		return false;
}

/*
 * Customizer
 */

require_once 'inc/customizer/customizer.php';
