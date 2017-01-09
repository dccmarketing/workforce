<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Workforce
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	do_action( 'workforce_entry_top' );

	?><header class="entry-header content"><?php

		/**
		 * @hooked 		title_entry 		10
		 */
		do_action( 'workforce_entry_header_content' );

	?></header><!-- .entry-header --><?php

	do_action( 'workforce_entry_content_before' );

	?><div class="entry-content"><?php

		/* translators: %s: Name of current post */
		the_content( sprintf(
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'workforce' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'workforce' ),
			'after'  => '</div>',
		) );

	?></div><!-- .entry-content --><?php

	do_action( 'workforce_entry_content_after' );

	?><footer class="entry-footer"><?php
		
		/**
		 * The workforce_entry_footer action hook.
		 *
		 * @hooked 		entry_categories_links() 		10
		 * @hooked		entry_tags_links() 				15
		 * @hooked		entry_comments_links() 			20
		 * @hooked 		entry_edit_link() 				25
		 */
		do_action( 'workforce_entry_footer_content' );

	?></footer><!-- .entry-footer --><?php

	do_action( 'workforce_entry_bottom' );

?></article><!-- #post-## -->