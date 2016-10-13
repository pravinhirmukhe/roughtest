<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Single Post Template
 *
 */

get_header();

	?><div class="container" id="main-content"><?php

		?><div id="page-container" class="left with-sidebar"><?php

			if(have_posts()):
			while(have_posts()) : the_post();

			?><div id="post-<?php the_ID(); ?>" <?php post_class("single-post"); ?>><?php

			?><div class="post-content"><?php
			?><div class="postmetadata"><?php
				if ( '' != get_the_post_thumbnail() ):	// As recommended from the WP codex, to avoid potential failure of has_post_thumbnail()
				?><div class="thumbnail"><?php
					the_post_thumbnail('post-thumbnail', array('class' => 'scale-with-grid'));
				?></div><?php
				endif;
				?><span class="meta-date published"><?php the_time(get_option('date_format')); ?></span><?php
				// Echo updated date for hatom-feed - not to be displayed on front end
				?><span class="updated"><?php the_modified_date(get_option('date_format')); ?></span><?php
				?><span class="meta-author vcard author"><?php
					_e('By ', 'silverclean-lite');
					?><span class="fn"><?php the_author(); ?></span><?php
				?></span><?php
				if ( has_category() ):
				?><span class="meta-category"><?php _e('In ', 'silverclean-lite'); the_category(', ') ?></span><?php
				endif;
				if (has_tag()):
					echo '<span class="tags">'; the_tags('<span class="tag">', '</span><span>', '</span></span>');
				endif;
				edit_post_link(__('Edit', 'silverclean-lite'), '<span class="editlink">', '</span>');
			?></div><?php
			?><h1 class="entry-title"><?php the_title(); ?></h1><?php
			the_content();
			?></div><?php // end post content
			?><div class="clear" /></div><?php

			$args = array(
				'before'           => '<br class="clear" /><div class="paged_nav">' . __('Pages:', 'silverclean-lite'),
				'after'            => '</div>',
				'link_before'      => '',
				'link_after'       => '',
				'next_or_number'   => 'number',
				'nextpagelink'     => __('Next page', 'silverclean-lite'),
				'previouspagelink' => __('Previous page', 'silverclean-lite'),
				'pagelink'         => '%',
				'echo'             => 1
			);
			wp_link_pages( $args );

			?></div><?php // end div post

			// Display comments section only if comments are open or if there are comments already.
			if ( comments_open() || get_comments_number()!=0 ):
				?><hr /><?php
				?><div class="comments"><?php
					comments_template( '', true );
				?></div><?php
			endif;

			endwhile;

			else:

			?><h2><?php _e('Not Found', 'silverclean-lite'); ?></h2><?php
			?><p><?php _e('What you are looking for isn\'t here...', 'silverclean-lite'); ?></p><?php

			endif;

			?><div class="article_nav"><?php

				if ( is_attachment() ):
				// Use image navigation links on attachment pages, post navigation otherwise

					if ( silverclean_adjacent_image_link(false) ): // Is there a previous image ?
					?><div class="previous"><?php previous_image_link(0, __("Previous Image", 'silverclean-lite') ); ?></div><?php
					endif;
					if ( silverclean_adjacent_image_link(true) ): // Is there a next image ?
					?><div class="next"><?php next_image_link(0, __("Next Image",'silverclean-lite') ); ?></div><?php
					endif;

				else:

					if ("" != get_adjacent_post( false, "", false ) ): // Is there a next post?
					?><div class="next"><?php next_post_link('%link', __("Next Post", 'silverclean-lite') ); ?></div><?php
					endif;
					if ("" != get_adjacent_post( false, "", true ) ): // Is there a previous post?
					?><div class="previous"><?php previous_post_link('%link', __("Previous Post", 'silverclean-lite') ); ?></div><?php
					endif;

				endif;

				?><br class="clear" /><?php
			?></div><?php

		?></div><?php // End page container

		?><div id="sidebar-container" class="right"><?php
			get_sidebar();
		?></div><?php // End sidebar column

	?></div><?php // End main content

get_footer();
