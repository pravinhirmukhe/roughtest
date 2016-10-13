<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Main Index
 *
 */

get_header();

?><div id="main-content" class="container"><?php

		?><div id="page-container" class="left with-sidebar"><?php

		/* SEARCH CONDITIONAL TITLE */
		if ( is_search() ):
		?><h1 class="page-title"><?php _e('Search Results for ', 'silverclean-lite'); ?>"<?php the_search_query() ?>"</h1><?php
		endif;

		/* TAG CONDITIONAL TITLE */
		if ( is_tag() ):
		?><h1 class="page-title"><?php _e('Tag: ', 'silverclean-lite'); single_tag_title(); ?></h1><?php
		endif;

		/* CATEGORY CONDITIONAL TITLE */
		if ( is_category() ):
		?><h1 class="page-title"><?php _e('Category: ', 'silverclean-lite'); single_cat_title(); ?></h1><?php
		endif;

		/* DEFAULT CONDITIONAL TITLE */
		if (!is_front_page() && !is_search() && !is_tag() && !is_category()):
		?><h1 class="page-title"><?php echo get_the_title(get_option('page_for_posts')); ?></h1><?php
		endif;

		if(have_posts()):
		while(have_posts()) : the_post();

			?><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

				?><div class="post-contents"><?php

					?><h3 class="entry-title"><?php
					?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a><?php
					?></h3><?php

					?><div class="post-content"><?php
				if ( get_post_format() || post_password_required() || "content" == get_theme_mod('silverclean_blog_index_content') )
						the_content();
					else the_excerpt();
					?></div><?php

				?></div><?php

				?><div class="postmetadata"><?php
					if ( '' != get_the_post_thumbnail() ):	// As recommended from the WP codex, to avoid potential failure of has_post_thumbnail()
						?><div class="thumbnail"><?php
				?><a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('post-thumbnail', array('class' => 'scale-with-grid')); ?></a></div><?php
					endif;
					?><span class="meta-date published"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_time(get_option('date_format')); ?></a></span><?php

					// Echo updated date for hatom-feed - not to be displayed on front end
					?><span class="updated"><?php the_modified_date(get_option('date_format')); ?></span><?php

					?><span class="meta-author vcard author"><?php
						_e('By ', 'silverclean-lite');
						?><span class="fn"><?php the_author(); ?></span><?php
					?></span><?php
					?><span class="meta-category"><?php _e('In ', 'silverclean-lite'); the_category(', ') ?></span><?php
					?><span class="meta-comments"><?php comments_popup_link( __( 'No Comment', 'silverclean-lite' ), __( '1 Comment', 'silverclean-lite' ), __( '% Comments', 'silverclean-lite' ) ); ?></span><?php
					if (has_tag()):
						echo '<span class="tags">'; the_tags('<span class="tag">', '</span><span>', '</span></span>');
					endif;
					?><span class="editlink"><?php edit_post_link(__('Edit', 'silverclean-lite'), '', ''); ?></span><?php
				?></div><?php

			?></div><?php // end div post

			?><hr /><?php

			endwhile;
			else:

			if (is_search() ):

				?><h2><?php _e('Nothing Found', 'silverclean-lite'); ?></h2><?php
				?><p><?php _e('Maybe a search will help ?', 'silverclean-lite'); ?></p><?php
				get_search_form();

			else:

				?><h2><?php _e('Not Found', 'silverclean-lite'); ?></h2><?php
				?><p><?php _e('What you are looking for isn\'t here...', 'silverclean-lite'); ?></p><?php

			endif;

		endif;

			?><div class="page_nav"><?php
				?><div class="previous"><?php next_posts_link( __('Previous Posts', 'silverclean-lite') ); ?></div><?php
				?><div class="next"><?php previous_posts_link( __('Next Posts', 'silverclean-lite') ); ?></div><?php
			?></div><?php

		?></div><?php // End page container

		?><div id="sidebar-container" class="right"><?php
			get_sidebar();
		?></div><?php // End sidebar

	?></div><?php // End main content

get_footer();
