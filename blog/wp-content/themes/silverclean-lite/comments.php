<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Comments template
 *
 */


if ( post_password_required() ): 
		?><p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'silverclean-lite'); ?></p><?php
		return;
	endif;

if ( have_comments() ):
	?><h3 id="comments"><?php
		printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'silverclean-lite' ),
					number_format_i18n( get_comments_number() ),  get_the_title() ); ?></h3><?php

	?><ol class="commentlist"><?php
	wp_list_comments( array('avatar_size' => 64 ) );
	?></ol><?php

	if ( silverclean_page_has_comments_nav() ): // If comments need pagination links
	?><div class="comments_nav"><?php
		?><div class="previous"><?php previous_comments_link( __('Older comments', 'silverclean-lite') ) ?></div><?php
		?><div class="next"><?php next_comments_link( __('Newer comments', 'silverclean-lite') ) ?></div><?php
	?></div><?php
	endif;

else : // this is displayed if there are no comments so far

	if ( comments_open() ): // If comments are open, but there are no comments.
	else : // comments are closed
		?><p class="nocomments"><?php _e('Comments are closed.', 'silverclean-lite'); ?></p><?php

	endif;
endif;


if ( comments_open() ) comment_form();