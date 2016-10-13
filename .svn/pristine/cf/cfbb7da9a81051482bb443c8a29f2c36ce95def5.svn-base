<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Template Name: Full-width Page Template, No Sidebar
 *
 */

get_header();

if(have_posts()) :
while(have_posts()) : the_post();

?><div class="container" id="main-content"><?php

	?><div id="page-container" <?php post_class(); ?>><?php

		?><h1 class="page-title"><?php the_title(); ?></h1><?php

		the_content();
			$silverclean_link_pages_args = array(
				'before'           => '<br class="clear" /><div class="paged_nav">' . __('Pages:', 'silverclean-lite'),
				'after'            => '</div>',
				'link_before'      => '<span>',
				'link_after'       => '</span>',
				'next_or_number'   => 'number',
				'nextpagelink'     => __('Next page', 'silverclean-lite'),
				'previouspagelink' => __('Previous page', 'silverclean-lite'),
				'pagelink'         => '%',
				'echo'             => 1
			);
			wp_link_pages( $silverclean_link_pages_args );

		?><br class="clear" /><?php
		?><p class="editlink"><?php edit_post_link(__('Edit', 'silverclean-lite'), '', ''); ?></p><?php

		// Display comments section only if comments are open or if there are comments already.
		if ( comments_open() || get_comments_number()!=0 ):
		?><div class="comments"><?php
			comments_template( '', true );
			next_comments_link(); previous_comments_link();
		?></div><?php
		endif;

endwhile;

else:
	?><h2><?php _e('Not Found', 'silverclean-lite'); ?></h2><?php
	?><p><?php _e('What you are looking for isn\'t here...', 'silverclean-lite'); ?></p><?php

endif;

?></div><?php // End page container

?></div><?php // End main content

get_footer();
