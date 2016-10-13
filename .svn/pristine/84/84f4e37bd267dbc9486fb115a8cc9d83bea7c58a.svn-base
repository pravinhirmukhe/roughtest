<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Footer Template
 *
 */ 

if (is_active_sidebar( 'footer-sidebar' ) ):
	?><div id="footer"><div class="container"><ul><?php
			dynamic_sidebar( 'footer-sidebar' );
		?></ul></div></div><?php
endif;

?><div id="sub-footer"><div class="container"><?php

/* You are free to modify or replace this by anything you like as per the terms of the GPL license */

printf( __('Copyright &copy; %s %s.', 'silverclean-lite'), date('Y'), get_bloginfo('name') );
echo ' ';
printf( __('Proudly powered by <a href="%s" title="%s">%s</a>.', 'silverclean-lite'),
	esc_url( __('https://wordpress.org/', 'silverclean-lite') ),
	esc_attr__( 'Semantic Personal Publishing Platform', 'silverclean-lite' ),
	__('WordPress', 'silverclean-lite')
);
echo ' ';
printf( __('Silverclean design by <a href="%s" title="%s">Iceable Themes</a>.', 'silverclean-lite'),
	esc_url( 'https://www.iceablethemes.com' ),
	esc_attr( 'Iceablethemes', 'silverclean-lite' )
);

/* Stop editing here */

?></div></div><?php // End sub footer

?></div><?php // End main wrap 

wp_footer();

?></body></html>