<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package ParaBlogger
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function parablogger_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'parablogger_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function parablogger_jetpack_setup
add_action( 'after_setup_theme', 'parablogger_jetpack_setup' );

function parablogger_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function parablogger_infinite_scroll_render